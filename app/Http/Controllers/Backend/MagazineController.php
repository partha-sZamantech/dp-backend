<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Services\Bn\BnVideoService;
use App\Models\BnVideo;
use App\Models\Magazine;
use App\Models\User;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::query()->addSelect([
            'uploader' => User::select('name')
                ->whereColumn('users.id', 'user_id')
                ->take(1)
        ])
            ->where('deletable', 1)
            ->latest()
            ->paginate(20);

        return view('backend.magazine.list', compact('magazines'));
    }

    public function create()
    {
        return view('backend.magazine.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'magazineName'  => 'required',
        ]);

        $video = new Magazine();

        $video->name    = $request->magazineName;
        $video->status  = $request->status;
        $video->user_id = auth()->id();
        $video->save();

        // Clear the cache
        return redirect('backend/magazines')->with('successMsg', 'The magazine has been added successfully!');
    }

    public function edit($id)
    {
        $magazine = Magazine::find($id);
        return view('backend.magazine.edit',compact('magazine'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'magazineName'  => 'required',
        ]);

        $video = Magazine::findOrFail($id);

        $video->name    = $request->magazineName;
        $video->status  = $request->status;
        $video->user_id = auth()->id();
        $video->save();

        // Clear the cache
        return redirect('backend/magazines')->with('successMsg', 'The magazine has been updated successfully!');
    }

    public function destroy($id)
    {
        Magazine::where('id', $id)->update(['deletable' => 2]);

        return redirect('backend/magazines')->with('successMsg', 'The magazine has been removed successfully!');
    }
}

<?php

namespace App\Http\Controllers\Backend\Magazine;

use App\Http\Controllers\Controller;
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
            'magazine_name'     => 'required',
            'meta_keywords'     => 'required',
            'meta_description'  => 'required',
            'share_image'       => 'required|image|mimes:jpeg,jpg,png|dimensions:width=750,height=390|max:100',
        ]);

        $magazine = new Magazine();

        $magazine->name            = $request->magazine_name;
        $magazine->meta_keywords   = $request->meta_keywords;
        $magazine->meta_description= $request->meta_description;

        if ($request->hasFile('share_image')) { // upload SM normal image
            $filename = 'magazine-'.$magazine->id.'-'.time().'.'.$request->file('share_image')->getClientOriginalExtension();
            $request->file('share_image')->move(config('appconfig.commonImagePath'), $filename);
            $magazine->og_img_path = $filename;
        }

        $magazine->status          = $request->status;
        $magazine->user_id         = auth()->id();
        $magazine->save();

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
            'magazine_name'     => 'required',
            'meta_keywords'     => 'required',
            'meta_description'  => 'required',
            'share_image'       => 'nullable|image|mimes:jpeg,jpg,png|dimensions:width=750,height=390|max:100',
        ]);

        $magazine = Magazine::findOrFail($id);

        $magazine->name            = $request->magazine_name;
        $magazine->meta_keywords   = $request->meta_keywords;
        $magazine->meta_description= $request->meta_description;
        if ($request->hasFile('share_image')) { // upload SM normal image
            $filename = 'magazine-'.$magazine->id.'-'.time().'.'.$request->file('share_image')->getClientOriginalExtension();
            $request->file('share_image')->move(config('appconfig.commonImagePath'), $filename);
            $magazine->og_img_path = $filename;
        }

        if ($request->status == 1){
            Magazine::query()->update(['status' => 2]);
        }
        $magazine->status  = $request->status;
        $magazine->user_id = auth()->id();
        $magazine->save();

        // Clear the cache
        return redirect('backend/magazines')->with('successMsg', 'The magazine has been updated successfully!');
    }

    public function destroy($id)
    {
        Magazine::where('id', $id)->update(['deletable' => 2]);

        return redirect('backend/magazines')->with('successMsg', 'The magazine has been removed successfully!');
    }
}

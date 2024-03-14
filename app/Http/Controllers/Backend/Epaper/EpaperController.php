<?php

namespace App\Http\Controllers\Backend\Epaper;

use App\Http\Controllers\Controller;
use App\Models\Epaper;
use App\Models\User;
use Illuminate\Http\Request;

class EpaperController extends Controller
{
    public function index()
    {
        $epapers = Epaper::query()->addSelect([
            'uploader' => User::select('name')
                ->whereColumn('users.id', 'user_id')
                ->take(1)
        ])
            ->where('deletable', 1)
            ->latest()
            ->paginate(20);

        return view('backend.epaper.list', compact('epapers'));
    }

    public function create()
    {
        return view('backend.epaper.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date'              => 'required|date',
            'meta_keywords'     => 'required',
            'meta_description'  => 'required',
            'share_image'       => 'nullable|image|mimes:jpeg,jpg,png|dimensions:width=750,height=390|max:100',
        ]);

        $paper = new Epaper();

        $paper->paper_date       = $request->date;
        $paper->meta_keywords    = $request->meta_keywords;
        $paper->meta_description = $request->meta_description;

        if ($request->hasFile('share_image')) { // upload SM normal image
            $filename = 'magazine-'.$paper->id.'-'.time().'.'.$request->file('share_image')->getClientOriginalExtension();
            $request->file('share_image')->move(config('appconfig.commonImagePath'), $filename);
            $paper->og_img_path = $filename;
        }

        $paper->status          = $request->status;
        $paper->user_id         = auth()->id();
        $paper->save();

        // Clear the cache
        return redirect(route('epapers.index'))->with('successMsg', 'The epaper has been added successfully!');
    }

    public function edit($id)
    {
        $paper = Epaper::find($id);
        return view('backend.epaper.edit',compact('paper'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'date'              => 'required|date',
            'meta_keywords'     => 'required',
            'meta_description'  => 'required',
            'share_image'       => 'nullable|image|mimes:jpeg,jpg,png|dimensions:width=750,height=390|max:100',
        ]);

        $paper = Epaper::findOrFail($id);

        $paper->paper_date      = $request->date;
        $paper->meta_keywords   = $request->meta_keywords;
        $paper->meta_description= $request->meta_description;
        if ($request->hasFile('share_image')) { // upload SM normal image
            $filename = 'magazine-'.$paper->id.'-'.time().'.'.$request->file('share_image')->getClientOriginalExtension();
            $request->file('share_image')->move(config('appconfig.commonImagePath'), $filename);
            $paper->og_img_path = $filename;
        }
        $paper->status  = $request->status;
        $paper->user_id = auth()->id();
        $paper->save();

        // Clear the cache
        return redirect(route('epapers.index'))->with('successMsg', 'The epaper has been updated successfully!');
    }

    public function destroy($id)
    {
        Epaper::where('id', $id)->update(['deletable' => 2]);

        return redirect(route('epapers.index'))->with('successMsg', 'The epaper has been removed successfully!');
    }
}

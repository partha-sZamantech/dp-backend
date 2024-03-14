<?php

namespace App\Http\Controllers\Backend\En;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Services\En\EnVideoService;
use App\Models\EnVideo;
use App\Models\EnVideoCategory;
use App\Models\User;
use Illuminate\Http\Request;

class EnVideoController extends Controller
{
    public function index()
    {
        $videos = EnVideo::query()->with('category:id,name')->addSelect([
            'created_by' => User::select('name')
                ->whereColumn('users.id', 'user_id')
                ->toBase()
                ->take(1)
        ])->orderByDesc('id')->get();

        return view('backend.en.video.list', compact('videos'));
    }

    public function create()
    {
        $categories = EnVideoCategory::query()->select(['id', 'name'])->where('status', 1)->where('deletable', 1)->get();
        return view('backend.en.video.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type'  => 'required',
            'title' => 'required',
            'image' => ['required','mimes:jpeg,jpg,png,gif','dimensions:width=750,height=390','max:100'],
        ]);

        $video = new EnVideo();

        $video->cat_id   = $request->category;
        $video->type     = $request->type;
        $video->title    = $request->title;
        if($request->hasFile('image')){
            $finalImageBGPath = FileController::imageIntervention($request->image, config('appconfig.videoImagePath'), 750, 390);

            // SM Image upload
            $finalImageSMPath = FileController::imageIntervention($request->image, config('appconfig.videoImagePath'), 320, 180, 'SM/');

            // XS Image upload
            $finalImageXSPath = FileController::imageIntervention($request->image, config('appconfig.videoImagePath'), 120, 62, 'XS/');

            // BG Image path
            $video->img_bg_path = $finalImageBGPath;

            // SM Image path
            $video->img_sm_path = $finalImageSMPath;

            // XS Image path
            $video->img_xs_path = $finalImageXSPath;
        }

        $video->code     = $request->code;
        $video->meta_keywords     = $request->metaKeywords;
        $video->meta_description  = $request->metaDescription;
        $video->status = $request->status;
        $video->user_id  = auth()->id();
        $video->save();

        // Clear the cache
        (new EnVideoService())->clearCache();

        return redirect('backend/en-videos')->with('successMsg', 'The video has been added successfully!');
    }

    public function edit($id)
    {
        $video = EnVideo::find($id);
        $categories = EnVideoCategory::query()->select(['id', 'name'])->where('status', 1)->where('deletable', 1)->get();
        return view('backend.en.video.edit',compact('video', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type'  => 'required',
            'title' => 'required',
            'image' => ['nullable','mimes:jpeg,jpg,png,gif','dimensions:width=750,height=390','max:100'],
        ],[
            'image.required_if' => 'The image field is required'
        ]);



        $video = EnVideo::find($id);

        $video->cat_id   = $request->category;
        $video->type     = $request->type;
        $video->title    = $request->title;
        if($request->hasFile('image')){
            $finalImageBGPath = FileController::imageIntervention($request->image, config('appconfig.videoImagePath'), 750, 390);

            // SM Image upload
            $finalImageSMPath = FileController::imageIntervention($request->image, config('appconfig.videoImagePath'), 320, 180, 'SM/');

            // XS Image upload
            $finalImageXSPath = FileController::imageIntervention($request->image, config('appconfig.videoImagePath'), 120, 62, 'XS/');

            // BG Image path
            $video->img_bg_path = $finalImageBGPath;

            // SM Image path
            $video->img_sm_path = $finalImageSMPath;

            // XS Image path
            $video->img_xs_path = $finalImageXSPath;
        }
        $video->code     = $request->code;
        $video->link     = $request->link;
        $video->meta_keywords     = $request->metaKeywords;
        $video->meta_description  = $request->metaDescription;
        $video->status = $request->status;
        $video->save();

        // Clear the cache
        (new EnVideoService())->clearCache($id);

        return redirect('backend/en-videos')->with('successMsg', 'The video has been updated successfully!');
    }

    public function destroy($id)
    {
        EnVideo::where('id', $id)->update(['deletable' => 2]);
        // Clear the cache
        (new EnVideoService())->clearCache();
        return redirect('backend/en-videos')->with('successMsg', 'The video has been removed successfully!');
    }
}

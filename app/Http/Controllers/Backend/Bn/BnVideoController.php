<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Services\Bn\BnVideoService;
use App\Models\BnVideo;
use App\Models\BnVideoCategory;
use App\Models\User;
use Illuminate\Http\Request;

class BnVideoController extends Controller
{
    public function index()
    {
        $videos = BnVideo::query()->with('category:id,name_bn')
            ->addSelect([
                'created_by' => User::select('name')
                    ->whereColumn('users.id', 'user_id')
                    ->take(1)
            ])
            ->where('title', 'like', '%'.request('keyword').'%')
            ->orWhere('code', request('keyword'))
            ->orderByDesc('id')
            ->paginate(20);

        return view('backend.bn.video.list', compact('videos'));
    }

    public function create()
    {
        $categories = BnVideoCategory::query()->select(['id', 'name_bn'])->where('status', 1)->where('deletable', 1)->get();
        return view('backend.bn.video.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type'  => 'required',
            'title' => 'required',
            'image' => ['required','mimes:jpeg,jpg,png,gif','dimensions:width=750,height=390','max:100'],
        ]);

        $video = new BnVideo();

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
        $video->target      = $request->target;
        $video->is_live     = $request->is_live;
        $video->status      = $request->status;
        $video->user_id     = auth()->id();
        $video->save();

        // Clear the cache
        (new BnVideoService())->clearCache();

        return redirect('backend/bn-videos')->with('successMsg', 'The video has been added successfully!');
    }

    public function edit($id)
    {
        $video = BnVideo::find($id);
        $categories = BnVideoCategory::query()->select(['id', 'name_bn'])->where('status', 1)->where('deletable', 1)->get();
        return view('backend.bn.video.edit',compact('video', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type'  => 'required',
            'title' => 'required',
            'image' => ['nullable','mimes:jpeg,jpg,png,gif','dimensions:width=750,height=390','max:100'],
        ]);

        $video = BnVideo::find($id);

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
        $video->target   = $request->target;
        $video->is_live  = $request->is_live;
        $video->status   = $request->status;
        $video->save();

        // Clear the cache
        (new BnVideoService())->clearCache($id);

        return redirect('backend/bn-videos')->with('successMsg', 'The video has been updated successfully!');
    }

    public function destroy($id)
    {
        BnVideo::where('id', $id)->update(['deletable' => 2]);
        // Clear the cache
        (new BnVideoService())->clearCache();
        return redirect('backend/bn-videos')->with('successMsg', 'The video has been removed successfully!');
    }
}

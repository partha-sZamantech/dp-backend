<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\Bn\BnHelperController;
use App\Http\Controllers\Controller;
use App\Http\Services\Bn\BnVideoService;
use App\Models\BnVideo;
use App\Models\BnVideoCategory;
use App\Models\BnVideoPosition;

class BnVideoFrontendController extends Controller
{
    public function index()
    {
        $specialTopVideos   = [];
        $specialTopPosition = BnVideoPosition::where('position_id', 3)->where('deletable', 1)->first();

        if ($specialTopPosition && $specialTopPosition->video_ids) {
            $aVideoIDs = explode(",", $specialTopPosition->video_ids);
            $aVideoIDs = array_slice($aVideoIDs, 0, $specialTopPosition->total_video);
            $sVideoIDs = implode(',', $aVideoIDs);

            $specialTopVideos = BnVideo::query()
                                       ->with('category:id,slug,name_bn')
                                       ->select([
                                           'id', 'cat_id', 'type', 'title', 'img_bg_path', 'img_sm_path', 'code',
                                           'target', 'is_live'
                                       ])
                                       ->whereIn('id', $aVideoIDs)
                                       ->where('status', 1)->where('deletable', 1)
                                       ->orderByRaw("FIELD(id, $sVideoIDs)")
                                       ->get();
        }

        $nationalVideos      = BnHelperController::getLatestCatVideo(1, 8);
        $saradeshVideos      = BnHelperController::getLatestCatVideo(2, 8);
        $entertainmentVideos = BnHelperController::getLatestCatVideo(4, 8);
        $internationalVideos = BnHelperController::getLatestCatVideo(3, 8);
        $lifestyleVideos     = BnHelperController::getLatestCatVideo(7, 8);

        return view('frontend.video.bn.home', compact('specialTopVideos', 'nationalVideos', 'saradeshVideos', 'entertainmentVideos', 'internationalVideos', 'lifestyleVideos'));
    }

    public function category($slug)
    {
        $category = BnVideoCategory::select(['id', 'slug', 'name_bn'])->where('slug', $slug)->firstOrFail();
        $videos   = [];
        if ($category) {
            $videos = BnVideo::query()
                             ->with('category:id,slug,name_bn')
                             ->select(['id', 'cat_id', 'type', 'title', 'img_bg_path', 'img_sm_path', 'code', 'target'])
                             ->where('cat_id', $category->id)->where('status', 1)->where('deletable', 1)
                             ->latest()
                             ->paginate(12);
        }

        return view('frontend.video.bn.category', compact('category', 'videos'));
    }

    public function bnVideoDetails($slug, $id)
    {
        $video = (new BnVideoService())->getVideo($id);
        if (empty($video)) abort(404);

        $bnVideos = (new BnVideoService())->getVideos(6);
        $bnVideos = $bnVideos->where('id', '!=', $video->id);

        $latestContents = BnHelperController::getLatestContent(5);

        return view('frontend.video.bn.details', compact('video', 'bnVideos', 'latestContents'));
    }
}


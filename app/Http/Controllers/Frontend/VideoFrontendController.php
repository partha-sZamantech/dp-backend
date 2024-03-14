<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\Bn\BnHelperController;
use App\Http\Controllers\Backend\En\EnHelperController;
use App\Http\Controllers\Controller;
use App\Http\Services\Bn\BnVideoService;
use App\Http\Services\En\EnVideoService;

class VideoFrontendController extends Controller
{
    public function bnVideoDetails($slug, $id)
    {
        $video = (new BnVideoService())->getVideo($id);
        if (empty($video)) abort(404);

        $bnVideos = (new BnVideoService())->getVideos(6);
        $bnVideos = $bnVideos->where('id', '!=', $video->id);

        $latestContents = BnHelperController::getLatestContent(5);

        return view('frontend.video.bn.details', compact('video', 'bnVideos', 'latestContents'));
    }

    public function enVideoDetails($id)
    {
        $video = (new EnVideoService())->getVideo($id);
        if (empty($video)) abort(404);

        $enVideos = (new EnVideoService())->getVideos(6);
        $enVideos = $enVideos->where('id', '!=', $video->id);

        $latestContents = EnHelperController::getLatestContent(5);

        return view('frontend.video.en.details', compact('video', 'enVideos', 'latestContents'));
    }
}


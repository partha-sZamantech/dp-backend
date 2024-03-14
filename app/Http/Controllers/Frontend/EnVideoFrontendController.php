<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\Bn\BnHelperController;
use App\Http\Controllers\Backend\En\EnHelperController;
use App\Http\Controllers\Controller;
use App\Http\Services\Bn\BnVideoService;
use App\Http\Services\En\EnVideoService;

class EnVideoFrontendController extends Controller
{
    public function index()
    {
        return view('frontend.video.bn.home');
    }

    public function enVideoDetails($slug, $id)
    {
        $video = (new EnVideoService())->getVideo($id);
        if (empty($video)) abort(404);

        $enVideos = (new EnVideoService())->getVideos(6);
        $enVideos = $enVideos->where('id', '!=', $video->id);

        $latestContents = EnHelperController::getLatestContent(5);

        return view('frontend.video.en.details', compact('video', 'enVideos', 'latestContents'));
    }
}


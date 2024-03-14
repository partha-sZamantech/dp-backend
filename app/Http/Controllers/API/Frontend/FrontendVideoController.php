<?php

namespace App\Http\Controllers\API\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BnVideo;

class FrontendVideoController extends Controller
{

    public function bnVideoDetails($slug, $id){
        $video = BnVideo::query()
            ->with('category:id,name_bn,slug')
            ->select(['id', 'cat_id', 'type', 'title', 'img_bg_path', 'link', 'code', 'created_at'])
            ->where('id', $id)
            ->orderBy('id')
            ->first();

        $videos = BnVideo::query()
            ->with('category:id,name_bn,slug')
            ->where('id', '!=', $video->id)
            ->select(['id', 'cat_id', 'type', 'title', 'img_sm_path', 'link', 'code', 'target', 'created_at'])
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();
        return response()->json([
            'video' => $video,
            'videos' => $videos
        ], 200);
    }


}

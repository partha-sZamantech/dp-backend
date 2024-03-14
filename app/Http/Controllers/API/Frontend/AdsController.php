<?php

namespace App\Http\Controllers\API\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BnAd;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function commonAds(Request $request){
        // 1 = Common, 2 = Home Page, 3 = Category Page, 4 = Details Page
        $allAds = BnAd::query()
            ->select(['id', 'type', 'page','status', 'position', 'dfp_header_code', 'code', 'desktop_image_path', 'mobile_image_path', 'external_link', 'start_time', 'end_time'])
            ->where('page', $request->page)
            ->where('position', $request->position)
            ->where('status', 1)
            ->where('deletable', 1)
            ->first();
        return response()->json($allAds, 200);
    }
}

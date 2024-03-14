<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Models\BnAuthor;
use App\Models\BnCategory;
use App\Models\BnContent;
use App\Models\EnContent;
use App\Models\User;

class BnDashboardController extends Controller
{
    public function index(){
        $totalContent = BnContent::where('deletable', 1)->where('status', 1)->count();
        $totalCategory = BnCategory::where('deletable', 1)->where('status', 1)->count();
        $totalAuthor = BnAuthor::where('deletable', 1)->count();
        $totalUser = User::where('deletable', 1)->where('visibility', 1)->count();
        $totalBnPendingContent = BnContent::where('deletable', 1)->where('status', 2)->count();
        $totalEnPendingContent = EnContent::where('deletable', 1)->where('status', 2)->count();

        return view('backend.dashboard', compact('totalContent', 'totalCategory', 'totalAuthor', 'totalUser', 'totalBnPendingContent', 'totalEnPendingContent'));
    }

    public function pendingEnglish(){

        $contents = EnContent::where('deletable', 1)->where('status', 2)->orderBy('content_id', 'DESC')->paginate(20);
        return view('backend.pending-content.en', compact('contents'));

    }

    public function pendingBangla(){

        $contents = BnContent::where('deletable', 1)->where('status', 2)->orderBy('content_id', 'DESC')->paginate(20);
        return view('backend.pending-content.bn', compact('contents'));

    }

}

<?php

namespace App\Http\Controllers\Backend\En;

use App\Http\Controllers\Controller;
use App\Models\EnContent;
use Illuminate\Http\Request;

class EnPendingContentController extends Controller
{
    public function enApprove($content_id){

        $enContent = EnContent::where('content_id', $content_id)->first();
        $enContent->status = 1;
        $enContent->save();
        return redirect('backend/pending/en-contents')->with('successMsg', 'The content has been updated successfully!');

    }
}

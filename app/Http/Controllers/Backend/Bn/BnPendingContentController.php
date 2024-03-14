<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Models\BnContent;
use Illuminate\Http\Request;

class BnPendingContentController extends Controller
{

    public function bnApprove($content_id){

        $bnContent = BnContent::where('content_id', $content_id)->first();
        $bnContent->status = 1;
        $bnContent->save();
        return redirect('backend/pending/bn-contents')->with('successMsg', 'The content has been updated successfully!');

    }

}

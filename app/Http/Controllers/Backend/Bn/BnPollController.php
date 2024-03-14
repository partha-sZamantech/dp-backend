<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Frontend\BnFrontendController;
use App\Models\BnPoll;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BnPollController extends Controller
{
    public function index(Request $request)
    {
        // Get search field values for pagination
        $exPartPagination = ["keyword" => $request->keyword];

        $polls = BnPoll::orderBy('poll_id', 'DESC');

        if ($request->keyword) {
            $polls = $polls->where('poll_id', trim($request->keyword))
                           ->orWhere('poll_title', $request->keyword);
        }

        $polls = $polls->where('deletable', 1)->paginate(12);

        return view('backend.polls.bn.index', compact('polls', 'exPartPagination'));
    }

    public function create()
    {
        return view('backend.polls.bn.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'poll_title' => ['required', 'string'],
            'photo'      => ['required', 'mimes:jpg,jpeg,png,gif,webp', 'dimensions:width=750,height=390', 'max:100'],
            'status'     => ['required', Rule::in([1, 2])]
        ]);

        $poll             = new BnPoll();
        $poll->poll_title = $request->poll_title;

        if ($request->hasFile('photo')) {
            $finalPhotoPath = FileController::imageIntervention($request->photo, config('appconfig.pollImagePath'), 750, 390);

            // SM Image upload
            $finalPhotoSMPath = FileController::imageIntervention($request->photo, config('appconfig.pollImagePath'), 320, 180, 'SM/');
        }
        $poll->image_path = $finalPhotoPath;
        $poll->sm_image_path = $finalPhotoSMPath;
        $poll->status     = $request->status;
        $poll->save();

        return redirect('backend/bn-polls')->with('successMsg', 'The poll has been successfully created!');
    }

    public function edit($id)
    {
        $poll = BnPoll::findOrFail($id);

        return view('backend.polls.bn.edit', compact('poll'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'poll_title' => ['required', 'string'],
            'photo'      => ['sometimes', 'required', 'mimes:jpg,jpeg,png,gif,webp', 'dimensions:width=750,height=390', 'max:100'],
            'status'     => ['required', Rule::in([1,2])]
        ]);

        $poll             = BnPoll::findOrFail($id);
        $poll->poll_title = $request->poll_title;
        if ($request->hasFile('photo')) {
            if (file_exists(config('appconfig.pollImagePath') . $poll->image_path)) {
                unlink(config('appconfig.pollImagePath') . $poll->image_path);
            }

            if (file_exists(config('appconfig.pollImagePath') . $poll->sm_image_path)) {
                unlink(config('appconfig.pollImagePath') . $poll->sm_image_path);
            }

            $finalPhotoPath = FileController::imageIntervention($request->photo, config('appconfig.pollImagePath'), 750, 390);

            // SM Image upload
            $finalPhotoSMPath = FileController::imageIntervention($request->photo, config('appconfig.pollImagePath'), 320, 180, 'SM/');

            $poll->image_path = $finalPhotoPath;
            $poll->sm_image_path = $finalPhotoSMPath;
        }
        $poll->status     = $request->status;
        $poll->save();

        return redirect('backend/bn-polls')->with('successMsg', 'The poll has been successfully created!');
    }

    public function destroy($id)
    {
        if (is_numeric($id)) {
            $poll = BnPoll::findOrFail($id);
            $poll->deletable = 2;
            $poll->save();

            return redirect('backend/bn-polls')->with('successMsg', 'The poll has been removed successfully!');
        }
    }
}

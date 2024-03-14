<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BnPoll;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BnPollFrontendController extends Controller
{
    public function index()
    {
        $active_polls = BnPoll::select('poll_id', 'sm_image_path', 'poll_title', 'yes_vote', 'no_vote', 'no_opinion', 'total_vote')
                              ->where([
                                  ['status', 1],
                                  ['deletable', 1]
                              ])->limit(3)->latest()->get();

        $inactive_polls = BnPoll::where([
            ['status', 2],
            ['deletable', 1]
        ])->latest()->limit(30)->get();

        $result = [];
        foreach ($inactive_polls as $value) {
            $yes_percentage         = round($value->yes_vote > 0 ? ($value->yes_vote * 100) / $value->total_vote : 0);
            $no_percentage          = round($value->no_vote > 0 ? ($value->no_vote * 100) / $value->total_vote : 0) ;
            $no_opinion_percentage  = round($value->no_opinion > 0 ? ($value->no_opinion * 100) / $value->total_vote : 0);

            $array[0] = ['Opinion', 'Percentage'];
            $array[1] = ["হ্যা", $yes_percentage];
            $array[2] = ["না", $no_percentage];
            $array[3] = ["মন্তব্য নেই", $no_opinion_percentage];

            array_push($result, $array);
        }

        $output = json_encode($result);

        return view('frontend.bn.poll-home', compact('active_polls', 'inactive_polls', 'output'));
    }

    public function submit_vote(Request $request)
    {
        $request->validate([
            'poll_id' => ['required', 'integer', 'exists:mysqlpoll.bn_polls,poll_id'],
            'value'   => ['required', 'integer', Rule::in([0, 1, 2])]
        ]);

        $poll = BnPoll::findOrFail($request->poll_id);

        if (!$poll) {
            return;
        }

        if ($request->value == 1) {
            $poll->yes_vote++;
        } elseif ($request->value == 2) {
            $poll->no_vote++;
        } else {
            $poll->no_opinion++;
        }

        $poll->total_vote++;
        $poll->save();

        return $request->poll_id;
    }

    public function change_vote(Request $request)
    {
        $request->validate([
            'poll_id' => ['required', 'integer', 'exists:mysqlpoll.bn_polls,poll_id'],
            'value'   => ['required', 'integer', Rule::in([0, 1, 2])]
        ]);

        $previous_vote = $request->votes[$request->poll_id] ?? [];

        $poll = BnPoll::findOrFail($request->poll_id);

        if (!$poll) {
            return;
        }

        if ($previous_vote == 1) {
            $poll->yes_vote -= 1;
        } elseif ($previous_vote == 2) {
            $poll->no_vote -= 1;
        } elseif ($previous_vote == 0) {
            $poll->no_opinion -= 1;
        }

        if ($request->value == 1) {
            $poll->yes_vote++;
        } elseif ($request->value == 2) {
            $poll->no_vote++;
        } elseif ($request->value == 0) {
            $poll->no_opinion++;
        }

        $poll->save();

        $data['poll_id'] = $request->poll_id;
        $data['value']   = $request->value;

        return $data;
    }
}

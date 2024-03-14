<?php

namespace App\Http\Controllers\Backend\En;

use App\Http\Controllers\Controller;
use App\Http\Services\En\EnVideoService;
use App\Models\EnVideo;
use App\Models\EnVideoPosition;
use DB;
use Illuminate\Http\Request;

class EnVideoPositionController extends Controller
{
    public function index()
    {
        $video_positions = EnVideoPosition::select(['position_id', 'position_name', 'cat_id', 'subcat_id', 'video_ids'])->where('deletable', 1)->get();

        return view('backend.en.video_position.position_list', compact('video_positions'));
    }

    public function create()
    {
        return view('backend.en.video_position.position_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'position_name' => 'required|unique:mysqlen.en_video_positions',
            'totalVideo' => 'numeric'
        ]);

        $position = new EnVideoPosition();
        $position->position_name   = $request->position_name;
        $position->cat_id          = $request->category_id;
        $position->subcat_id       = $request->subcat_id;
        $position->total_video   = $request->totalVideo;
        $position->save();

        return redirect('backend/en-video-position')->with('successMsg', 'The video position has been inserted successfully!');
    }

    public function edit($id)
    {
        $position = EnVideoPosition::find($id);
        return view('backend.en.video_position.position_edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'position_name' => 'required|unique:mysqlen.en_video_positions,position_name,'.$id.',position_id',
            'totalVideo' => 'numeric'
        ]);

        $position = EnVideoPosition::find($id);
        $position->position_name   = $request->position_name;
        $position->cat_id          = $request->category_id;
        $position->subcat_id       = $request->subcat_id;
        $position->total_video   = $request->totalVideo;
        $position->save();

        return redirect('backend/en-video-position')->with('successMsg', 'The video position has been updated successfully!');

    }

    public function destroy($id)
    {
        if(is_numeric($id)){
            EnVideoPosition::where('position_id', $id)->update(['deletable' => 2]);
            return redirect('backend/en-video-position')->with('successMsg', 'The video position has been removed successfully!');
        }
    }

    public function autocompleteEnVideoSearch(Request $request){ // Autocomplete news search for news position
        $term = $request->term.'%';
        $data = EnVideo::select('id', 'title', 'created_at')
            ->where('deletable', 1)
            ->where('id', 'like', $term)
            ->orWhere('title', 'like', $term)
            ->take(50)->get();
        $return_array = [];

        foreach ($data as $v) {
            $return_array[] = array('value' => $v->id . ' - ' . $v->title . ' - (' . $v->created_at .')' , 'id' =>$v->id);
        }

        return $return_array;
    }

    public function populatePosition(Request $request){
        $position = EnVideoPosition::find($request->position);
        $videos = [];
        if($position->video_ids) {
            $video_ids = explode(',', $position->video_ids);
            $videos = EnVideo::select('id', 'title')->whereIn('id', $video_ids)->orderByRaw(DB::raw("FIELD(id, $position->video_ids)"))->get();
        }
        return ['videos' => $videos, 'position' => $position];
    }

    public function getChangePosition($id){
        $allPositions = EnVideoPosition::where('deletable', 1)->get();
        $enPosition = EnVideoPosition::find($id);
        $allVideos = '';
        if(!empty($enPosition->video_ids)){
            $content_ids = explode(',', $enPosition->video_ids);

            $allVideos = EnVideo::select('id', 'title')->whereIn('id', $content_ids)->orderByRaw(DB::raw("FIELD(id, $enPosition->video_ids)"))->get();
        }

        return view('backend.en.video_position.position_set', compact('allPositions', 'allVideos', 'enPosition'));
    }

    public function changePosition(Request $request){

        $data = [];
        parse_str($request->data, $data);
        $position = EnVideoPosition::find($request->id);

        $position->video_ids = implode(',', array_slice($data['item'], 0, $position->total_video+2));
        $position->save();

        // Clear the home page cache
        (new EnVideoService())->clearCache();

        return $position;
    }
}

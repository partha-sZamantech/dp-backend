<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\BnFrontendController;
use App\Http\Services\Bn\BnVideoService;
use App\Models\BnContent;
use App\Models\BnVideo;
use App\Models\BnVideoPosition;
use App\Models\BnSiteSettings;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BnVideoPositionController extends Controller
{
    public function index()
    {
        $video_positions = BnVideoPosition::select(['position_id', 'position_name', 'cat_id', 'subcat_id', 'video_ids'])->where('deletable', 1)->get();

        return view('backend.bn.video_position.position_list', compact('video_positions'));
    }

    public function create()
    {
        return view('backend.bn.video_position.position_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'position_name' => 'required|unique:bn_video_positions',
            'totalVideo' => 'numeric'
        ]);

        $position = new BnVideoPosition();
        $position->position_name   = $request->position_name;
        $position->cat_id          = $request->category_id;
        $position->subcat_id       = $request->subcat_id;
        $position->total_video   = $request->totalVideo;
        $position->save();

        return redirect('backend/bn-video-position')->with('successMsg', 'The video position has been inserted successfully!');
    }

    public function edit($id)
    {
        $position = BnVideoPosition::find($id);
        return view('backend.bn.video_position.position_edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'position_name' => 'required|unique:bn_video_positions,position_name,'.$id.',position_id',
            'totalVideo' => 'numeric'
        ]);

        $position = BnVideoPosition::find($id);
        $position->position_name   = $request->position_name;
        $position->cat_id          = $request->category_id;
        $position->subcat_id       = $request->subcat_id;
        $position->total_video   = $request->totalVideo;
        $position->save();

        return redirect('backend/bn-video-position')->with('successMsg', 'The video position has been updated successfully!');

    }

    public function destroy($id)
    {
        if(is_numeric($id)){
            BnVideoPosition::where('position_id', $id)->update(['deletable' => 2]);
            return redirect('backend/bn-video-position')->with('successMsg', 'The video position has been removed successfully!');
        }
    }


    public function autocompleteBnVideoSearch(Request $request){ // Autocomplete news search for news position
        $term = $request->term.'%';
        $data = BnVideo::select('id', 'title', 'created_at')
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
        $position = BnVideoPosition::find($request->position);
        $videos = [];
        if($position->video_ids) {
            $video_ids = explode(',', $position->video_ids);
            $videos = BnVideo::select('id', 'title')->whereIn('id', $video_ids)->orderByRaw(DB::raw("FIELD(id, $position->video_ids)"))->get();
        }

        // For special section settings

        if ($position->position_id == 1) {
            $settings = BnSiteSettings::select('show_live_tv')->first();
            $position->setAttribute('show_live_tv', optional($settings)->show_live_tv);
        } elseif ($position->position_id == 3) {
            $settings = BnSiteSettings::select('show_video_live_tv')->first();
            $position->setAttribute('show_video_live_tv', optional($settings)->show_video_live_tv);
        }

        return ['videos' => $videos, 'position' => $position];
    }

    public function getChangePosition($id){
        $allPositions = BnVideoPosition::where('deletable', 1)->get();
        $bnPosition = BnVideoPosition::find($id);
        $allVideos = '';
        if(!empty($bnPosition->video_ids)){
            $content_ids = explode(',', $bnPosition->video_ids);

            $allVideos = BnVideo::select('id', 'title')->whereIn('id', $content_ids)->orderByRaw(DB::raw("FIELD(id, $bnPosition->video_ids)"))->get();
        }

        if ($bnPosition->position_id == 1) {
            $settings = BnSiteSettings::select('show_live_tv')->first();
            $bnPosition->setAttribute('show_live_tv', optional($settings)->show_live_tv);
        } elseif ($bnPosition->position_id == 3) {
            $settings = BnSiteSettings::select('show_video_live_tv')->first();
            $bnPosition->setAttribute('show_video_live_tv', optional($settings)->show_video_live_tv);
        }

        return view('backend.bn.video_position.position_set', compact('allPositions', 'allVideos', 'bnPosition'));
    }

    public function changePosition(Request $request){

        if ($request->id == 1) {
            $settings = $request->settings;
            BnSiteSettings::where('id', 1)->update([
                'show_live_tv' => $settings['show_live_tv'],
            ]);
            Cache::forget('bnSiteSettings');
        } elseif ($request->id == 3) {
            $settings = $request->settings;
            BnSiteSettings::where('id', 1)->update([
                'show_video_live_tv' => $settings['show_video_live_tv'],
            ]);
            Cache::forget('bnSiteSettings');
        }

        $data = [];
        parse_str($request->data, $data);
        $position = BnVideoPosition::find($request->id);

        $position->video_ids = implode(',', array_slice($data['item'], 0, $position->total_video+2));
        $position->save();

        // Clear the home page cache
        (new BnVideoService())->clearCache();

        return $position;
    }
}

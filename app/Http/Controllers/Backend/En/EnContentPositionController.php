<?php

namespace App\Http\Controllers\Backend\En;

use App\Http\Controllers\Controller;
use App\Models\EnContent;
use App\Models\EnContentPosition;
use App\Models\EnSiteSettings;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EnContentPositionController extends Controller
{
    public function index()
    {
        $content_positions = EnContentPosition::where('deletable', 1)->get();
        return view('backend.en.content_position.en_content_position_list', compact('content_positions'));
    }

    public function create()
    {
        return view('backend.en.content_position.en_content_position_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'position_name' => 'required|unique:mysqlen.en_content_positions'
        ]);

        $news_position = new EnContentPosition();
        $news_position->position_name   = $request->position_name;
        $news_position->position_slug   = fFormatURL($request->position_name);
        $news_position->cat_id          = $request->category_id;
        $news_position->special_cat_id  = $request->special_cat_id;
        $news_position->subcat_id       = $request->subcat_id;
        $news_position->total_content   = $request->totalContent;
        $news_position->save();

        return redirect('backend/en-content-position')->with('successMsg', 'The content position has been inserted successfully!');
    }

    public function edit($id)
    {
        $position = EnContentPosition::find($id);
        return view('backend.en.content_position.en_content_position_edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'position_name' => 'required'
        ]);

        $news_position = EnContentPosition::find($id);
        $news_position->position_name   = $request->position_name;
        $news_position->position_slug   = fFormatURL($request->position_name);
        $news_position->cat_id          = $request->category_id;
        $news_position->special_cat_id  = $request->special_cat_id;
        $news_position->subcat_id       = $request->subcat_id;
        $news_position->total_content   = $request->totalContent;
        $news_position->save();

        return redirect('backend/en-content-position')->with('successMsg', 'The content position has been updated successfully!');

    }

    public function destroy($id)
    {
        if(is_numeric($id)){
            EnContentPosition::where('position_id', $id)->update(['deletable' => 2]);
            return redirect('backend/en-content-position')->with('successMsg', 'The content position has been removed successfully!');
        }
    }


    public function autocompleteEnContentSearch(Request $request){ // Autocomplete news search for news position
        $term = $request->term.'%';
//        $position = EnContentPosition::find($request->posId);

//        if ($position->cat_id) {
//            $data = EnContent::select('content_id', 'content_heading', 'created_at')
//                ->where('cat_id', $position->cat_id)
//                ->where(function ($q) use ($term) {
//                    $q->where('content_id', 'like', $term)
//                        ->orWhere('content_heading', 'like', $term);
//                })
//                ->where('deletable', 1)->take(50)->get();
//        }else{
            $data = EnContent::select('content_id', 'content_heading', 'deletable', 'created_at')
                ->where('deletable', 1)
                ->where('content_id', 'like', $term)
                ->orWhere('content_heading', 'like', $term)
                ->take(50)->get();
//        }
        //return $data;
        $return_array = [];

        foreach ($data as $v) {
            $return_array[] = array('value' => $v->content_id . ' - ' . $v->content_heading . ' - (' . $v->created_at .')' , 'id' =>$v->content_id);
        }

        return $return_array;
    }

    public function populatePosition(Request $request){
        $news_position = EnContentPosition::find($request->position);
        $data = ['position' => $news_position];
        if($news_position->content_ids) {
            $content_ids = explode(',', $news_position->content_ids);
            $allnews = EnContent::select('content_id', 'content_heading')->whereIn('content_id', $content_ids)->orderByRaw(DB::raw("FIELD(content_id, $news_position->content_ids)"))->get();
            $data['news'] = $allnews;
        }
        return $data;
    }

    public function getChangePosition($id){
        $allpositions = EnContentPosition::where('deletable', 1)->get();
        $news_position = EnContentPosition::find($id);
        $allnews = '';
        if(!empty($news_position->content_ids)){
            $content_ids = explode(',', $news_position->content_ids);

            $allnews = EnContent::select('content_id', 'content_heading')->whereIn('content_id', $content_ids)->orderByRaw(DB::raw("FIELD(content_id, $news_position->content_ids)"))->get();
        }

        // For special section settings
        $settings = (object)[];
        if ($news_position->position_id == 2) {
            $settings = EnSiteSettings::select(['show_special', 'special_title', 'special_link'])->first();
        }

        return view('backend.en.content_position.en_content_position_set', compact('allpositions', 'allnews', 'news_position', 'settings'));
    }

    public function postEnSetPosition(Request $request){
        //return $request->position;
        $positionId = $request->positionName;

        $news_position = EnContentPosition::find($positionId);
        //return $news_position_ids;
        if($news_position){
            $news_position_ids = $news_position->content_ids;
            $aNews_position_ids = explode(',', $news_position_ids);
            $new_position = [$request->position-1 => $request->newsId];
            array_splice($aNews_position_ids, $request->position-1, 1, $new_position);
            $sNews_position_ids = implode(',', $aNews_position_ids);

            EnContentPosition::where('position_id', $positionId)->update(['content_ids' => $sNews_position_ids]);
            // if (!is_null($news_position->cat_id)){
            //     new GenerateHTMLController($news_position->cat_id);
            // }elseif (!is_null($news_position->special_cat_id)){
            //     new GenerateHTMLController(null, $news_position->special_cat_id);
            // }elseif (!is_null($news_position->subcat_id)){
            //     new GenerateHTMLController(null, null, $news_position->subcat_id);
            // }
            return redirect('backend/en-content-position/change/'.$positionId);
        }else{
            return false;
        }
    }

    public function changePosition(Request $request){
        if ($request->id == 2) {
            $settings = $request->settings;
            // 1 = Site settings first row
            EnSiteSettings::where('id', 1)->update([
                'show_special' => $settings['show_special'],
                'special_title' => $settings['special_title'],
                'special_link' => $settings['special_link'],

            ]);
            Cache::forget('bnSiteSettings');
        }

        $data = [];
        parse_str($request->data, $data);
        $position = EnContentPosition::find($request->id);

        $position->content_ids = implode(',', array_slice($data['item'], 0, $position->total_content+2));
        $position->save();

        // if (!is_null($position->cat_id)){
        //     new GenerateHTMLController($position->cat_id);
        // }elseif (!is_null($position->special_cat_id)){
        //     new GenerateHTMLController(null, $position->special_cat_id);
        // }elseif (!is_null($position->subcat_id)){
        //     new GenerateHTMLController(null, null, $position->subcat_id);
        // }
        return $position;
    }
}

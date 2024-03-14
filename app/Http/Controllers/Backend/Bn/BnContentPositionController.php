<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\BnFrontendController;
use App\Models\BnContent;
use App\Models\BnContentPosition;
use App\Models\BnFixedPosition;
use App\Models\BnSiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;

class BnContentPositionController extends Controller
{
    public function index()
    {

        $content_positions = BnContentPosition::select(['position_id', 'position_name', 'cat_id', 'subcat_id', 'special_cat_id', 'content_ids', 'status'])->where('deletable', 1)->get();

        return view('backend.bn.content_position.content_position_list', compact('content_positions'));
    }

    public function create()
    {
        return view('backend.bn.content_position.content_position_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'position_name' => 'required|unique:bn_content_positions',
            'category_id' => 'unique:bn_content_positions,cat_id'
        ]);

        $news_position = new BnContentPosition();
        $news_position->position_name   = $request->position_name;
        $news_position->position_slug   = fFormatURL($request->position_name);
        $news_position->cat_id          = $request->category_id;
        $news_position->special_cat_id  = $request->special_cat_id;
        $news_position->subcat_id       = $request->subcat_id;
        $news_position->total_content   = $request->totalContent;
        $news_position->status          = $request->status;
        $news_position->save();

        return redirect('backend/bn-content-position')->with('successMsg', 'The content position has been inserted successfully!');
    }

    public function edit($id)
    {
        $position = BnContentPosition::find($id);
        return view('backend.bn.content_position.content_position_edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'position_name' => 'required',
            'category_id' => 'nullable:bn_content_positions,cat_id,'.$id.',position_id'
        ]);

        $news_position = BnContentPosition::find($id);
        $news_position->position_name   = $request->position_name;
        $news_position->position_slug   = fFormatURL($request->position_name);
        $news_position->cat_id          = $request->category_id;
        $news_position->special_cat_id  = $request->special_cat_id;
        $news_position->subcat_id       = $request->subcat_id;
        $news_position->total_content   = $request->totalContent;
        $news_position->status          = $request->status;
        $news_position->save();

        return redirect('backend/bn-content-position')->with('successMsg', 'The content position has been updated successfully!');

    }

    public function destroy($id)
    {
        if(is_numeric($id)){
            BnContentPosition::where('position_id', $id)->update(['deletable' => 2]);
            return redirect('backend/bn-content-position')->with('successMsg', 'The content position has been removed successfully!');
        }
    }


    public function autocompleteBnContentSearch(Request $request){ // Autocomplete news search for news position
        $term = $request->term.'%';
//        $position = BnContentPosition::find($request->posId);

//        if ($position->cat_id) {
//            $data = BnContent::select('content_id', 'content_heading', 'created_at')
//                ->where('cat_id', $position->cat_id)
//                ->where(function ($q) use ($term) {
//                    $q->where('content_id', 'like', $term)
//                        ->orWhere('content_heading', 'like', $term);
//                })
//                ->where('deletable', 1)->take(50)->get();
//        }else{
            $data = BnContent::select('content_id', 'content_heading', 'created_at')
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
        $news_position = BnContentPosition::find($request->position);
        if($news_position->content_ids) {
            $content_ids = explode(',', $news_position->content_ids);
            $allnews = BnContent::select('content_id', 'content_heading')->whereIn('content_id', $content_ids)->orderByRaw(DB::raw("FIELD(content_id, $news_position->content_ids)"))->get();

            // For special section settings
            $settings = (object)[];
            if ($news_position->position_id == 2) {
                $settings = BnSiteSettings::select(['show_special', 'special_title', 'special_link'])->first();
            }

            return ['news' => $allnews, 'position' => $news_position, 'settings' => $settings];
        }
    }

    public function getChangePosition($id){
        $allpositions = BnContentPosition::where('deletable', 1)->get();
        $news_position = BnContentPosition::find($id);
        $allnews = '';
        if(!empty($news_position->content_ids)){
            $content_ids = explode(',', $news_position->content_ids);

            $allnews = BnContent::select('content_id', 'content_heading')->whereIn('content_id', $content_ids)->orderByRaw(DB::raw("FIELD(content_id, $news_position->content_ids)"))->get();
        }

        // For special section settings
        $settings = (object)[];
        if ($news_position->position_id == 2) {
            $settings = BnSiteSettings::select(['show_special', 'special_title', 'special_link'])->first();
        }

        return view('backend.bn.content_position.content_position_set', compact('allpositions', 'allnews', 'news_position', 'settings'));
    }

    public function postBnSetPosition(Request $request){
        //return $request->position;
        $positionId = $request->positionName;

        $news_position = BnContentPosition::find($positionId);
        //return $news_position_ids;
        if($news_position){
            $news_position_ids = $news_position->content_ids;
            $aNews_position_ids = explode(',', $news_position_ids);
            $new_position = [$request->position-1 => $request->newsId];
            array_splice($aNews_position_ids, $request->position-1, 1, $new_position);
            $sNews_position_ids = implode(',', $aNews_position_ids);

            BnContentPosition::where('position_id', $positionId)->update(['content_ids' => $sNews_position_ids]);
            // if (!is_null($news_position->cat_id)){
            //     new GenerateHTMLController($news_position->cat_id);
            // }elseif (!is_null($news_position->special_cat_id)){
            //     new GenerateHTMLController(null, $news_position->special_cat_id);
            // }elseif (!is_null($news_position->subcat_id)){
            //     new GenerateHTMLController(null, null, $news_position->subcat_id);
            // }
            return redirect('backend/bn-content-position/change/'.$positionId);
        }else{
            return false;
        }
    }

    public function changePosition(Request $request){
        // 1=Special top, 2=special section
        /*if ($request->id == 1 || $request->id == 2) {
            // Update the special settings
            $settings = $request->settings;
            if ($request->id == 1) {
                BnSiteSettings::where('id', 1)->update([
                    'show_special_top_video' => $settings['show_special_top_video'],
                    'special_top_video_code' => $settings['special_top_video_code'],
                    'special_top_video_type' => $settings['special_top_video_type'],

                ]);
            }

            if ($request->id == 2) {
                BnSiteSettings::where('id', 1)->update([
                    'show_special' => $settings['show_special'],
                    'special_title' => $settings['special_title'],
                    'special_link' => $settings['special_link'],

                ]);
            }

            Cache::forget('bnSiteSettings');
        }*/
        /*if ($request->id == 2) {
            $settings = $request->settings;
            BnSiteSettings::where('id', 1)->update([
                'show_special' => $settings['show_special'],
                'special_title' => $settings['special_title'],
                'special_link' => $settings['special_link'],

            ]);
            Cache::forget('bnSiteSettings');
        }*/

        $data = [];
        parse_str($request->data, $data);
        $position = BnContentPosition::find($request->id);

        $position->content_ids = implode(',', array_slice($data['item'], 0, $position->total_content+2));
        $position->save();

        // Clear the home page cache
        (new BnFrontendController())->clearHomePageContentCache();

        return $position;
    }

    public function fixContentPosition(){
        $position = BnFixedPosition::first();
        return view('backend.bn.content_position.fix_content_position', compact('position'));
    }

    public function updateContentPositionFixed(Request $request){
        $position = BnFixedPosition::find(1);
        $position->position_fix = $request->position_fix;
        $position->save();
        return redirect()->back()->with('successMsg', 'The content position fixed has been successfully!');;
    }
}

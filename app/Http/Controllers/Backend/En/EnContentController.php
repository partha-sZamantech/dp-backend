<?php

namespace App\Http\Controllers\Backend\En;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Frontend\BnFrontendController;
use App\Http\Controllers\MonthlyFolderController;
use App\Models\BnAuthor;
use App\Models\Country;
use App\Models\District;
use App\Models\EnAuthor;
use App\Models\EnCategory;
use App\Models\EnContent;
use App\Models\EnContentPosition;
use App\Models\EnSubcategory;
use App\Models\EnTag;
use App\Models\MisUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EnContentController extends Controller
{
    /*public function __construct()
    {
        $this->sMonthlyImageFolder = MonthlyFolderController::getLastMonthlyFolder() . '/';
    }*/

    public function populateCat(Request $request){
        if ($request->cat_id == 1 || $request->cat_id == 2){
            $categories = EnCategory::select('cat_id as id', 'cat_name as name')->where('cat_type', $request->cat_id)->where('deletable', 1)->get();
        }elseif ($request->cat_id == 3){
            $categories = EnSubcategory::select('subcat_id as id', 'subcat_name as name')->where('deletable', 1)->get();
        }
        return $categories;
    }

    public function index(Request $request)
    {
        // Get search field values for pagination
        $exPartPagination = ["catType" => $request->catType, "catId" => $request->catId, "dateRange" => $request->dateRange, "searchBy" => $request->searchBy, "keyword" => $request->keyword];

        $contents = EnContent::with(['category', 'specialCategory', 'subCategory', 'uploader:id,name']);
        if ($request->catType == 1){ // Search content with category
            $contents = $contents->where('cat_id', $request->catId);
        }elseif ($request->catType == 2){ // Search content with Special category
            $contents = $contents->where('special_cat_id', $request->catId);
        }elseif ($request->catType == 3){ // Search content with Subcategory
            $contents = $contents->where('subcat_id', $request->catId);
        }

        if ($request->searchBy == 1){ // Search content with ID
            $contents = $contents->where('content_id', trim($request->keyword));
        }elseif ($request->searchBy == 2){ // Search content with Heading
            $contents = $contents->where('content_heading', 'like', '%'.trim($request->keyword).'%');
        }elseif ($request->searchBy == 3){ // Search content with Writer
            $writer = EnAuthor::where('author_name_bn', 'like', trim($request->keyword).'%')->first();
            //return $writer->author_id;
            if ($writer->author_id){
                $contents = $contents->where('author_slugs', 'like', '%'.$writer->author_id.'%');
            }
        }
        $contents = $contents->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(20);

        $categories = EnCategory::where('cat_type', 1)->where('deletable', 1)->get();
        $specialCategories = EnCategory::where('cat_type', 2)->where('deletable', 1)->get();
        $districts = District::where('deletable', 1)->orderBy('district_name')->get();

        return view('backend.en.content.en_content_list', compact('contents', 'categories', 'specialCategories', 'districts', 'exPartPagination'));
    }

    public function create()
    {
        $authors = EnAuthor::where('deletable', 1)->get();
        $categories = EnCategory::where('cat_type', 1)->where('status', 1)->where('deletable', 1)->get();
        $specialCategories = EnCategory::where('cat_type', 2)->where('deletable', 1)->get();
        $countries = Country::where('deletable', 1)->orderBy('country_name')->get();
        $districts = District::where('deletable', 1)->orderBy('district_name')->get();
        $mis_reporters = MisUser::where('user_type', 1)->where('deletable', 1)->get();

        return view('backend.en.content.en_content_create', compact('authors', 'categories', 'specialCategories', 'countries', 'districts', 'mis_reporters'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'newsHeading' => 'required',
            'metaKeywords' => 'required',
            'briefNews' => 'required',
            'detailsNews' => 'required',
            'largeImage' => 'required|mimes:jpeg,jpg,png,gif|dimensions:width=750,height=390|max:150',
        ],[
            'briefNews.required' => "Meta Description is required."
        ]);

        $content = new EnContent();
        $content->content_heading = $request->newsHeading;
        $content->content_sub_heading = $request->newsSubheading;
        $content->author_slugs = $request->writer;
        $content->content_brief = $request->briefNews;
        $content->content_details = $request->detailsNews;
        $content->podcast_id = $request->podcastId;

        if ($request->largeImage) { // BG Image
            if ($request->hasFile('largeImage')) { // upload SM normal image
                $finalImageBGPath = FileController::imageIntervention($request->largeImage,config('appconfig.contentImagePath'),750,390);

                // SM Image upload
                $finalImageSMPath = FileController::imageIntervention($request->largeImage, config('appconfig.contentImagePath'), 320, 180,'SM/');

                // XS Image upload
                $finalImageXSPath = FileController::imageIntervention($request->largeImage, config('appconfig.contentImagePath'), 120, 62,'XS/');
            }
            // BG Image path
            $content->img_bg_path = $finalImageBGPath;
            $content->img_bg_caption = $request->ImageBGCaption;

            // SM Image path
            $content->img_sm_path = $finalImageSMPath;
//            $content->img_sm_caption = $request->ImageSMCaption;

            // XS Image path
            $content->img_xs_path = $finalImageXSPath;
        }

        $content->content_type = $request->contentType;
        $content->cat_id = $request->category;
        $content->subcat_id = $request->subCategory;
        $content->special_cat_id = $request->specialCategory;
        $content->country_id = $request->country;
        $content->district_id = $request->district;
        if ($request->district){
            $content->division_id   = District::find($request->district)->division_id;
        }
        $content->upozilla_id = $request->upozilla;
        $content->uploader_id = auth()->id();
        if ($request->prevNewsIds) $content->related_ids = implode(',', $request->prevNewsIds);
        if ($request->photoGalaryIds) $content->photo_ids = implode(',', $request->photoGalaryIds);
        $content->video_type = $request->videoType;
        $content->video_id = $request->videoId;
        $content->tags = $request->normalTags;
        $content->meta_keywords = $request->metaKeywords;
//        $content->scroll = $request->scroll;

        // 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin
        if (auth()->user()->role === 1 || auth()->user()->role === 2){
            $content->status = $request->status;
        }else{
            $content->status = 2;
        }
//        $content->status = $request->status;

        $content->save();

        // Insert news position
        if ($request->category && $request->category_position) {

            $type = 'cat';
            $this->setNewsPosition($type, $request->category, $request->category_position, $content->content_id);
        }

        if ($request->specialCategory && $request->special_position) {
            $type = 'special_cat';
            $this->setNewsPosition($type, $request->specialCategory, $request->special_position, $content->content_id);
        }

        // Clear Bn home page english content
        Cache::forget((new BnFrontendController())->englishContentsCacheKey);

        return redirect('backend/en-contents')->with('successMsg', 'The content has been uploaded successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $content = EnContent::find($id);
        $authors = EnAuthor::where('deletable', 1)->get();
        $categories = EnCategory::where('cat_type', 1)->where('deletable', 1)->get();
        $specialCategories = EnCategory::where('cat_type', 2)->where('deletable', 1)->get();
        $countries = Country::where('deletable', 1)->get();
        $districts = District::where('deletable', 1)->get();
        $mis_reporters = MisUser::where('user_type', 1)->where('deletable', 1)->get();

        $normaltag_list = [];

        if ($content->tags) {
            $normal_tags = explode(',', $content->tags);
            foreach ($normal_tags as $normal_tag) {
                $normaltag = EnTag::select('tag_name', 'tag_slug')->where('tag_slug', $normal_tag)->first();
                if ($normaltag) $normaltag_list[] = ['id' => $normaltag->tag_slug, 'name' => $normaltag->tag_name];
            }
        }

        return view('backend.en.content.en_content_edit', compact('content', 'authors', 'categories', 'specialCategories', 'countries', 'districts', 'mis_reporters', 'normaltag_list'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'newsHeading' => 'required',
            'metaKeywords' => 'required',
            'briefNews' => 'required',
            'largeImage' => 'mimes:jpeg,jpg,png,gif|dimensions:width=750,height=390|max:150',
            'detailsNews' => 'required',
        ],[
            'briefNews.required' => "Meta Description is required."
        ]);

        $content = EnContent::find($id);
        $content->content_heading = $request->newsHeading;
        $content->content_sub_heading = $request->newsSubheading;
        $content->author_slugs = $request->writer;
        $content->content_brief = $request->briefNews;
        $content->content_details = $request->detailsNews;

        //==================== Content Position Update when select category :: Partha ==========================
        if ($content->cat_id != $request->category){
            //Remove Category Position Content Id
            $bnContentPosition = EnContentPosition::where('cat_id', $content->cat_id)->first();
            if ($bnContentPosition){
                $getArrayIds = explode(',', $bnContentPosition->content_ids);
                $updateContentIds = array_diff($getArrayIds, array($content->content_id));
                $bnContentPosition->content_ids = implode(',', $updateContentIds);
                $bnContentPosition->save();
            }

            // Add Category Position Content Id
            $bnUpdateContentPosition = EnContentPosition::where('cat_id', $request->category)->first();
            if ($bnUpdateContentPosition){
                $getUpdateArrayIds = explode(',', $bnUpdateContentPosition->content_ids);
                $newUpdateContentIds = array_push($getUpdateArrayIds, $content->content_id);
                $bnUpdateContentPosition->content_ids = implode(',', $getUpdateArrayIds);
                $bnUpdateContentPosition->save();
            }

        }
        //==================== Content Position Update when select category :: Partha ============================


        if ($request->largeImage) { // BG Image
            if ($request->hasFile('largeImage')) { // upload SM normal image
                $finalImageBGPath = FileController::imageIntervention($request->largeImage,config('appconfig.contentImagePath'),750,390);

                // SM Image upload
                $finalImageSMPath = FileController::imageIntervention($request->largeImage, config('appconfig.contentImagePath'), 320, 180, 'SM/');

                // XS Image upload
                $finalImageXSPath = FileController::imageIntervention($request->largeImage, config('appconfig.contentImagePath'), 120, 62, 'XS/');
            }
            // BG Image path
            $content->img_bg_path = $finalImageBGPath;

            // SM Image path
            $content->img_sm_path = $finalImageSMPath;
//            $content->img_sm_caption = $request->ImageSMCaption;

            // XS Image path
            $content->img_xs_path = $finalImageXSPath;
        }
        $content->img_bg_caption = $request->ImageBGCaption;

        $content->content_type = $request->contentType;
        $content->cat_id = $request->category;
        $content->subcat_id = $request->subCategory;
        $content->special_cat_id = $request->specialCategory;
        $content->country_id = $request->country;
        $content->district_id = $request->district;
        if ($request->district){
            $content->division_id   = District::find($request->district)->division_id;
        }
        $content->upozilla_id = $request->upozilla;
        if ($request->prevNewsIds) $content->related_ids = implode(',', $request->prevNewsIds);
        if ($request->photoGalaryIds) $content->photo_ids = implode(',', $request->photoGalaryIds);
        $content->video_type = $request->videoType;
        $content->video_id = $request->videoId;

        $content->tags = $request->normalTags;
        $content->meta_keywords = $request->metaKeywords;
        $content->podcast_id = $request->podcastId;
//        $content->scroll = $request->scroll;

        // 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin
        if (auth()->user()->role === 1 || auth()->user()->role === 2){
            $content->status = $request->status;
        }

        if ($content->status == 1) {
            $content->created_at = now();
        }

        $content->save();
        //new GenerateHTMLController($request->category, $request->specialCategory, $request->subCategory);

        // Clear Bn home page english content
        Cache::forget((new BnFrontendController())->englishContentsCacheKey);

        return redirect('backend/en-contents')->with('successMsg', 'The content has been updated successfully!');
    }

    public function destroy($id)
    {
        if (is_numeric($id)) {
            EnContent::where('content_id', $id)->update(['deletable' => 2]);
            return redirect('backend/en-contents')->with('successMsg', 'The content has been removed successfully!');
        }
    }

    public function deletedList()
    {
        $contents = EnContent::with('category', 'specialCategory', 'subCategory')->where('deletable', 2)->orderBy('content_id', 'desc')->get();

        return view('backend.bn.content.en_deleted_content_list', compact('contents'));
    }

    public function enableContent($id)
    {
        if ($id) {
            EnContent::where('content_id', $id)->update(['deletable' => 1]);
            return redirect('backend/deleted-en-contents')->with('successMsg', 'The content has been enabled!');
        }
    }

    public function getQuickUpdateContent(Request $request)
    {
        $id = $request->id;
        $content = EnContent::find($id);
        return \Response::json($content);
    }

    public function postQuickUpdate(Request $request)
    {
        $content = EnContent::find($request->contentId);
        $content->cat_id = $request->category;
        $content->subcat_id = $request->subCategory;
        $content->special_cat_id = $request->specialCategory;
        $content->district_id = $request->district;
        if ($request->district){
            $content->division_id   = District::find($request->district)->division_id;
        }
        $content->status = $request->showNews;
//        $content->scroll = $request->scroll;
        $content->save();

        return redirect('backend/en-contents')->with('successMsg', 'The content has been quick-updated successfully!');
    }

    private function setNewsPosition($type, $catId, $position, $contentId)
    {
        $news_position = '';
        if ($type == 'cat') {
            $news_position = EnContentPosition::where('cat_id', $catId)->first();
        } elseif ($type == 'special_cat') {
            $news_position = EnContentPosition::where('special_cat_id', $catId)->first();
        } elseif ($type == 'subcat') {
            $news_position = EnContentPosition::where('subcat_id', $catId)->first();
        }

        //return $news_position_ids;
        if (!empty($news_position)) {
            $news_position_ids = $news_position->content_ids;
            $aNews_position_ids = explode(',', $news_position_ids);
            $new_position = [$position - 1 => $contentId];
            array_splice($aNews_position_ids, $position - 1, 0, $new_position);
            $sNews_position_ids = implode(',', $aNews_position_ids);

            if ($type == 'cat') {
                EnContentPosition::where('cat_id', $catId)->update(['content_ids' => $sNews_position_ids]);
            } elseif ('special_cat') {
                EnContentPosition::where('special_cat_id', $catId)->update(['content_ids' => $sNews_position_ids]);
            } elseif ('subcat') {
                EnContentPosition::where('subcat_id', $catId)->update(['content_ids' => $sNews_position_ids]);
            }
        }
        return true;
    }
}

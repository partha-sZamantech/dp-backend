<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Frontend\BnFrontendController;
use Illuminate\Support\Facades\File;
use App\Models\BnAuthor;
use App\Models\BnCategory;
use App\Models\BnContent;
use App\Models\BnContentPosition;
use App\Models\BnSubcategory;
use App\Models\BnTag;
use App\Models\Country;
use App\Models\District;
use App\Models\MisUser;
use App\Models\User;
use App\Models\BnSiteSettings;
use App\Models\BnFixedPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BnContentController extends Controller
{
    public function populateCat(Request $request){
        if ($request->cat_id == 1 || $request->cat_id == 2){

            if (auth()->user()->bn_cat_ids) {
                $categories = BnCategory::select('cat_id as id', 'cat_name_bn as name')->where('cat_type', $request->cat_id)->whereIn('cat_id', explode(',', auth()->user()->bn_cat_ids))->where('status', 1)->where('deletable', 1)->get();

            } else {
                $categories = BnCategory::select('cat_id as id', 'cat_name_bn as name')->where('cat_type', $request->cat_id)->where('status', 1)->where('deletable', 1)->get();

            }

        }elseif ($request->cat_id == 3){
            $categories = BnSubcategory::select('subcat_id as id', 'subcat_name_bn as name')->where('deletable', 1)->get();
        }
        return $categories;
    }


    public function getOG($category,$image,$filename )
    {
        $imgPath = $image;

        $type = null;

        if (!$imgPath) abort(404);
        $ogImage = BnSiteSettings::where('id', 1)->first();
//        $watermarkFile = '/media/ogImages/og-common.png';
        $watermarkFile = '/media/ogImages/'.$ogImage->post_ogimage;
        if (File::exists(getcwd().'/media/ogImages/og-' . $category . '.png')) {
            $watermarkFile = '/media/ogImages/og-' . $category . '.png';
        }

//        $watermarkFile = '/media/ogImages/newfacebook.jpg';
//        if (File::exists(getcwd().'/media/ogImages/og-' . $category . '.jpg')) {
//            $watermarkFile = '/media/ogImages/og-' . $category . '.jpg';
//        }

        $aImg = explode('.', $imgPath);
        $imgExt = $aImg[count($aImg) - 1];

        if (!in_array($imgExt, ['jpg', 'jpeg', 'png', 'gif'])) abort(404);
//        if (!Storage::exists('media/content/images/' . $imgPath)) abort(404);

        // Load the logo stamp and the photo to apply the watermark to
        $imgFunc = $imgExt == 'png' ? 'imagecreatefrompng' : ($imgExt == 'gif' ? 'imagecreatefromgif' : 'imagecreatefromjpeg');

        $logo = imagecreatefrompng(getcwd().$watermarkFile);
        $path = $type == 'video' ? config('appconfig.videoImagePath') : ($type == 'photo' ? config('appconfig.photoAlbumImagePath') : config('appconfig.contentImagePath'));

        $img = $imgFunc(getcwd().'/'.$path.$imgPath);

        // Set the margins for the stamp and get the height/width of the stamp image
        $marge_right = 0;
        $marge_bottom = 0;
        $logox = imagesx($logo);
        $logoy = imagesy($logo);
        $imgx = imagesx($img);
        $imgy = imagesy($img);

        // width to calculate positioning of the stamp.
        imagecopy($img, $logo, $imgx - $logox - $marge_right, $imgy - $logoy - $marge_bottom, 0, 0, $logox, $logoy);
        // Output and free memory
        header('Content-type: image/jpeg');
        imagejpeg( $img, getcwd().'/media/content/images/ogimages/' . $filename.".png" );

        imagedestroy($img);
    }


    public function index(Request $request)
    {
        // Get search field values for pagination
        $exPartPagination = ["catType" => $request->catType, "catId" => $request->catId, "dateRange" => $request->dateRange, "searchBy" => $request->searchBy, "keyword" => $request->keyword];

        $contents = BnContent::with('category', 'specialCategory', 'subCategory', 'uploader:id,name');
        if ($request->catType == 1){ // Search content with category
            $contents->where('cat_id', $request->catId);
        }elseif ($request->catType == 2){ // Search content with Special category
            $contents->where('special_cat_id', $request->catId);
        }elseif ($request->catType == 3){ // Search content with Subcategory
            $contents->where('subcat_id', $request->catId);
        }

        if ($request->searchBy == 1){ // Search content with ID
            $contents->where('content_id', trim($request->keyword));
        }elseif ($request->searchBy == 2){ // Search content with Heading
            $contents->where('content_heading', 'like', '%'.trim($request->keyword).'%');
        }elseif ($request->searchBy == 3){ // Search content with Writer
            $writer = BnAuthor::where('author_name', 'like', '%'.trim($request->keyword).'%')->orWhere('author_name_bn', 'like', '%'.trim($request->keyword).'%')->first();
            //return $writer->author_id;
            if ($writer && $writer->author_slug){
                $contents->where('author_slugs', 'like', '%'.$writer->author_slug.'%');
            }
        } elseif ($request->searchBy == 4) {
            $uploader = User::where('name', 'like', '%'.trim($request->keyword).'%')->first();
            if ($uploader) {
                $contents->where('uploader_id', $uploader->id);
            }
        }

        // If the user is catAdmin=4
        if (auth()->user()->bn_cat_ids) {
            $contents->whereIn('cat_id', explode(',', auth()->user()->bn_cat_ids));
        }

        $contents = $contents->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(20);

        if (auth()->user()->bn_cat_ids) {
            $categories = BnCategory::where('cat_type', 1)->whereIn('cat_id', explode(',', auth()->user()->bn_cat_ids))->where('status', 1)->where('deletable', 1)->get();
        } else {
            $categories = BnCategory::where('cat_type', 1)->where('status', 1)->where('deletable', 1)->get();
        }

        $specialCategories = BnCategory::where('cat_type', 2)->where('deletable', 1)->get();
        $districts = District::where('deletable', 1)->orderBy('district_name')->get();

        return view('backend.bn.content.content_list', compact('contents', 'categories', 'specialCategories', 'districts', 'exPartPagination'));
    }

    public function create()
    {
        $authors = BnAuthor::where('deletable', 1)->get();
        if (auth()->user()->bn_cat_ids) {
            $categories = BnCategory::where('cat_type', 1)->whereIn('cat_id', explode(',', auth()->user()->bn_cat_ids))->where('status', 1)->where('deletable', 1)->get();
        } else {
            $categories = BnCategory::where('cat_type', 1)->where('status', 1)->where('deletable', 1)->get();
        }
        $specialCategories = BnCategory::where('cat_type', 2)->where('deletable', 1)->get();
        $countries = Country::where('deletable', 1)->orderBy('country_name')->get();
        $districts = District::where('deletable', 1)->orderBy('district_name')->get();
        $mis_reporters = MisUser::where('user_type', 1)->where('deletable', 1)->get();
//        $tag_letters = DB::select('select DISTINCT(SUBSTR(tag_name, 1, 1)) AS indexChar, ROW_NUMBER() OVER( ORDER BY indexChar asc) as UID from bn_tags group by indexChar');
        //return $categories;
        $fix_position = BnFixedPosition::first();
        return view('backend.bn.content.content_create', compact('authors', 'fix_position', 'categories', 'specialCategories', 'countries', 'districts', 'mis_reporters'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'newsHeading' => 'required',
            'metaKeywords' => 'required',
            'briefNews' => 'required',
            'detailsNews' => 'required',
            //            'largeImage' => 'mimes:jpeg,jpg,png,gif|dimensions:width=750,height=390|max:300',
            'largeImage' => 'dimensions:width=750,height=390|max:2048',
        ],[
            'briefNews.required' => "Meta Description is required."
        ]);


        $content = new BnContent();
        $content->content_heading = $request->newsHeading;
        $content->content_sub_heading = $request->newsSubheading;
        $content->author_slugs = $request->author;
        $content->author_name  = $request->authorName;
        $content->content_brief = $request->briefNews;
        $content->content_details = $request->detailsNews;


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
            $content->img_bg_caption = $request->ImageBGCaption;

            // SM Image path
            $content->img_sm_path = $finalImageSMPath;
//            $content->img_sm_caption = $request->ImageSMCaption;

            // XS Image path
            $content->img_xs_path = $finalImageXSPath;

            // Og image generate
            $fileName = "dhaka-prokash-" .rand(10000000,99999999);
            $socialImage= $this->getOG('1111', $finalImageBGPath, $fileName);
            $content->og_image = "/media/content/images/ogimages/".$fileName.".png";
            // Og image generate

//            $img = file_get_contents(getcwd().'/media/ogImages/' . "partha.png");
//
//// Encode the image string data into base64
//            $data = base64_encode($img);
// Display the output

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
        $content->reporter_id = $request->reporter;
        $content->uploader_id = auth()->id();
        if ($request->prevNewsIds) $content->related_ids = implode(',', $request->prevNewsIds);
        if ($request->photoGalaryIds) $content->photo_ids = implode(',', $request->photoGalaryIds);
        $content->video_type = $request->videoType;
        $content->video_id = $request->videoId;
        $content->tags = $request->normalTags;
        $content->meta_keywords = $request->metaKeywords;

        // 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin
        if (auth()->user()->role === 1 || auth()->user()->role === 2){
            $content->status = $request->status;
        }else{
            $content->status = 2;
        }

        $content->podcast_id = $request->podcastId;

        $content->save();

        // Insert news position
        if ($request->category && $request->categoryPosition) {
            $type = 'cat';
            $this->setNewsPosition($type, $request->category, $request->categoryPosition, $content->content_id);
        }
        // Generate HTML
        //new GenerateHTMLController($request->category, $request->specialCategory, $request->subCategory);
//        if ($request->specialCategory && $request->specialCategoryPosition) {
//            $type = 'special_cat';
//            $this->setNewsPosition($type, $request->specialCategory, $request->specialCategoryPosition, $content->content_id);
//        }

        // Insert news position
        if ($request->category && $request->category_position) {
            $this->setNewsPosition('cat', $request->category, $request->category_position, $content->content_id);
        }

        if ($request->specialCategory && $request->special_position) {
            $this->setNewsPosition('special_cat', $request->specialCategory, $request->special_position, $content->content_id);
        }

        // Clear home page cache
        (new BnFrontendController())->clearHomePageContentCache();

        return redirect('backend/bn-contents')->with('successMsg', 'The content has been submitted successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $content = BnContent::find($id);
        $authors = BnAuthor::where('deletable', 1)->get();
        if (auth()->user()->bn_cat_ids) {
            $categories = BnCategory::where('cat_type', 1)->whereIn('cat_id', explode(',', auth()->user()->bn_cat_ids))->where('status', 1)->where('deletable', 1)->get();
        } else {
            $categories = BnCategory::where('cat_type', 1)->where('status', 1)->where('deletable', 1)->get();
        }
        $specialCategories = BnCategory::where('cat_type', 2)->where('deletable', 1)->get();
        $countries = Country::where('deletable', 1)->get();
        $districts = District::where('deletable', 1)->get();
        $mis_reporters = MisUser::where('user_type', 1)->where('deletable', 1)->get();
//        $tag_letters = DB::select('select DISTINCT(SUBSTR(tag_name, 1, 1)) AS indexChar, ROW_NUMBER() OVER( ORDER BY indexChar asc) as UID from bn_tags group by indexChar');

        $author_list = [];
        if ($content->author_slugs) {
            $author_slugs = explode(',', $content->author_slugs);
            foreach ($author_slugs as $slug) {
                $author = BnAuthor::select('author_name_bn', 'author_slug')->where('author_slug', $slug)->first();
                if ($author) $author_list[] = ['id' => $author->author_slug, 'name' => $author->author_name_bn];
            }
        }

        $normaltag_list = [];
        if ($content->tags) {
            $normal_tags = explode(',', $content->tags);
            foreach ($normal_tags as $normal_tag) {
                $normaltag = BnTag::select('tag_name', 'tag_slug')->where('tag_slug', $normal_tag)->first();
                if ($normaltag) $normaltag_list[] = ['id' => $normaltag->tag_slug, 'name' => $normaltag->tag_name];
            }
        }

        /*$peopletag_list = [];

        if ($content->people_tags) {
            $people_tags = explode(',', $content->people_tags);
            foreach ($people_tags as $people_tag) {
                $peopletag = BnTag::select('tag_name', 'tag_slug')->where('tag_slug', $people_tag)->first();
                if ($peopletag) $peopletag_list[] = ['id' => $peopletag->tag_slug, 'name' => $peopletag->tag_name];
            }
        }*/

        /*$placetag_list = [];

        if ($content->place_tags) {
            $place_tags = explode(',', $content->place_tags);
            $placetag_list = [];
            foreach ($place_tags as $place_tag) {
                $placetag = BnTag::select('tag_name', 'tag_slug')->where('tag_slug', $place_tag)->first();
                if ($placetag) $placetag_list[] = ['id' => $placetag->tag_slug, 'name' => $placetag->tag_name];
            }
        }*/
        //return $categories;

        return view('backend.bn.content.content_edit', compact('content', 'authors', 'categories', 'specialCategories', 'countries', 'districts', 'mis_reporters', 'author_list', 'normaltag_list'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'newsHeading' => 'required',
            'metaKeywords' => 'required',
            'briefNews' => 'required',
            'detailsNews' => 'required',
//            'largeImage' => 'mimes:jpeg,jpg,png,gif|dimensions:width=750,height=390|max:300',
            'largeImage' => 'dimensions:width=750,height=390|max:2048',
        ],[
            'briefNews.required' => "Meta Description is required."
        ]);


        $content = BnContent::find($id);
        $content->content_heading = $request->newsHeading;
        $content->content_sub_heading = $request->newsSubheading;
        $content->author_slugs = $request->author;
        $content->author_name  = $request->authorName;
        $content->content_brief = $request->briefNews;
        $content->content_details = $request->detailsNews;

        //==================== Content Position Update when select category :: Partha ==========================
        if ($content->cat_id != $request->category){
            //Remove Category Position Content Id
            $bnContentPosition = BnContentPosition::where('cat_id', $content->cat_id)->first();
            if ($bnContentPosition){
                $getArrayIds = explode(',', $bnContentPosition->content_ids);
                $updateContentIds = array_diff($getArrayIds, array($content->content_id));
                $bnContentPosition->content_ids = implode(',', $updateContentIds);
                $bnContentPosition->save();
            }


            // Add Category Position Content Id
            $bnUpdateContentPosition = BnContentPosition::where('cat_id', $request->category)->first();
            if ($bnUpdateContentPosition){
                $getUpdateArrayIds = explode(',', $bnUpdateContentPosition->content_ids);
                $newUpdateContentIds = array_push($getUpdateArrayIds, $content->content_id);
                $bnUpdateContentPosition->content_ids = implode(',', $getUpdateArrayIds);
                $bnUpdateContentPosition->save();
            }


        }
        //==================== Content Position Update when select category ==========================


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

//            // Og Image Generate
//            $socialImage= $this->getOG('1111', $finalImageBGPath, 'partha');
//            $img = file_get_contents(getcwd().'/media/ogImages/' . "partha.png");
//            // Encode the image string data into base64
//            $data = base64_encode($img);
//            $content->og_image = "data:image/jpeg;base64,$data";
//            // Og Image Generate

            $fileName = "dhaka-prokash-" .rand(10000000,99999999);
            // Og image generate
            if($content->og_image !== null){
                if(File::exists(public_path($content->og_image))){
                    unlink(public_path($content->og_image));
                    $socialImage= $this->getOG('1111', $finalImageBGPath, $fileName);
                    $content->og_image = "/media/content/images/ogimages/".$fileName.".png";
                }else{
                    $socialImage= $this->getOG('1111', $finalImageBGPath, $fileName);
                    $content->og_image = "/media/content/images/ogimages/".$fileName.".png";
                }
            }else{
                $socialImage= $this->getOG('1111', $finalImageBGPath, $fileName);
                $content->og_image = "/media/content/images/ogimages/".$fileName.".png";
            }



            // Og image generate

        }else{


            // Og image generate
            $fileName = "dhaka-prokash-" .rand(10000000,99999999);
            if($content->og_image !== null){
                if(File::exists(public_path($content->og_image))){
                    unlink(public_path($content->og_image));
                    $socialImage= $this->getOG('1111', $content->img_bg_path, $fileName);
                    $content->og_image = "/media/content/images/ogimages/".$fileName.".png";
                }else{
                    $socialImage= $this->getOG('1111', $content->img_bg_path, $fileName);
                    $content->og_image = "/media/content/images/ogimages/".$fileName.".png";
                }
            }else{
                $socialImage= $this->getOG('1111', $content->img_bg_path, $fileName);
                $content->og_image = "/media/content/images/ogimages/".$fileName.".png";
            }


            // Og image generate


        }
        $content->img_bg_caption = $request->ImageBGCaption;
        $content->content_type = $request->contentType;
        $content->cat_id = $request->category;
        $content->subcat_id = $request->subCategory;
        $content->special_cat_id = $request->specialCategory;
        $content->country_id = $request->country;
        $content->district_id = $request->district;
        if ($request->district){
            $content->division_id = District::find($request->district)->division_id;
        }
        $content->upozilla_id = $request->upozilla;
        $content->reporter_id = $request->reporter;
        if ($request->prevNewsIds) $content->related_ids = implode(',', $request->prevNewsIds);
        if ($request->photoGalaryIds) $content->photo_ids = implode(',', $request->photoGalaryIds);
        $content->video_type = $request->videoType;
        $content->video_id = $request->videoId;

        $content->tags = $request->normalTags;
        $content->meta_keywords = $request->metaKeywords;

        if (auth()->user()->role === 1 || auth()->user()->role === 2){
            $content->status = $request->status;
        }

//        $content->status = $request->status;
        $content->podcast_id = $request->podcastId;

        /*if ($content->status == 1) {
            $content->created_at = now();
        }*/






        $content->save();
        //new GenerateHTMLController($request->category, $request->specialCategory, $request->subCategory);

        // Clear home page cache
        (new BnFrontendController())->clearHomePageContentCache();

        return redirect('backend/bn-contents')->with('successMsg', 'The content has been updated successfully!');

    }

    public function destroy($id)
    {
        if (is_numeric($id)) {
            BnContent::where('content_id', $id)->update(['deletable' => 2]);
            return redirect('backend/bn-contents')->with('successMsg', 'The content has been removed successfully!');
        }
    }

    public function deletedList()
    {
        $contents = BnContent::with('category', 'specialCategory', 'subCategory')->where('deletable', 2)->orderBy('content_id', 'desc')->get();

        return view('backend.bn.content.deleted_content_list', compact('contents'));
    }

    public function enableContent($id)
    {
        if ($id) {
            BnContent::where('content_id', $id)->update(['deletable' => 1]);
            return redirect('backend/deleted-bn-contents')->with('successMsg', 'The content has been enabled!');
        }
    }

    public function getQuickUpdateContent(Request $request)
    {
        $id = $request->id;
        $content = BnContent::find($id);
        return \Response::json($content);
    }

    public function postQuickUpdate(Request $request)
    {
        $content = BnContent::find($request->contentId);
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

        return redirect('backend/bn-contents')->with('successMsg', 'The content has been quick-updated successfully!');
    }

    private function setNewsPosition($type, $catId, $position, $contentId)
    {
        $news_position = '';
        if ($type == 'cat') {
            $news_position = BnContentPosition::where('cat_id', $catId)->first();
        } elseif ($type == 'special_cat') {
            $news_position = BnContentPosition::where('special_cat_id', $catId)->first();
        } elseif ($type == 'subcat') {
            $news_position = BnContentPosition::where('subcat_id', $catId)->first();
        }

        //return $news_position_ids;
        if (!empty($news_position)) {
            $news_position_ids = $news_position->content_ids;
            $aNews_position_ids = explode(',', $news_position_ids);
            $new_position = [$position - 1 => $contentId];
            array_splice($aNews_position_ids, $position - 1, 0, $new_position);
            $sNews_position_ids = implode(',', $aNews_position_ids);
            if ($type == 'cat') {
                BnContentPosition::where('cat_id', $catId)->update(['content_ids' => $sNews_position_ids]);
            } elseif ('special_cat') {
                BnContentPosition::where('special_cat_id', $catId)->update(['content_ids' => $sNews_position_ids]);
            } elseif ('subcat') {
                BnContentPosition::where('subcat_id', $catId)->update(['content_ids' => $sNews_position_ids]);
            }

            return true;
        }
    }
}

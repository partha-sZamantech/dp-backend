<?php

namespace App\Http\Controllers\API\Frontend;

use App\Http\Controllers\Backend\Bn\BnHelperController;
use App\Http\Controllers\Controller;
use App\Models\BnAuthor;
use App\Models\BnBreakingNews;
use App\Models\BnCategory;
use App\Models\BnSiteSettings;
use App\Models\BnSubcategory;
use App\Models\BnTag;
use App\Models\BnVideoPosition;
use App\Models\PhotoAlbum;
use App\Models\PhotoAlbumPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use App\Http\Services\Bn\BnContentService;
use App\Http\Controllers\Frontend\FileController;
use App\Models\BnVideo;

use App\Models\BnContent;
use App\Models\BnContentPosition;

class HomeController extends Controller
{
    public function breakingNews(){
        $breakingNews = BnBreakingNews::query()
            ->select(['id', 'news_title', 'news_link', 'expired_time'])
            ->where('expired_time', '>', now())
            ->orderBy('position')
            ->get();

        return response()->json($breakingNews, 200);
    }

    public function specialVideo(){

            $videos = [];
            $specialTopPosition = BnVideoPosition::where('position_id', 1)->where('deletable', 1)->first();

            if ($specialTopPosition && $specialTopPosition->video_ids) {
                $aVideoIDs = explode(",", $specialTopPosition->video_ids);
                $aVideoIDs = array_slice($aVideoIDs, 0, $specialTopPosition->total_video);
                $sVideoIDs = implode(',', $aVideoIDs);

                $videos = BnVideo::query()
                    ->with('category:id,slug,name_bn')
                    ->select(['id', 'cat_id', 'type', 'title', 'img_bg_path', 'img_sm_path', 'code', 'is_live', 'target'])
                    ->whereIn('id', $aVideoIDs)
                    ->where('status', 1)->where('deletable', 1)
                    ->orderByRaw("FIELD(id, $sVideoIDs)")
                    ->take(5)->get();
            }


        return response()->json($videos, 200);
    }

    public function headerCategory(){
        $headerCategory = BnCategory::where('cat_type', 1)->where('top_menu', 1)->where('status', 1)->where('deletable', 1)->orderBy('cat_position')->take(13)->get();
        return response()->json($headerCategory, 200);
    }

    public function siteSetting(){
        $setting = BnSiteSettings::first();
        return response()->json($setting, 200);
    }

    public function allCategory(){
        $allCat = BnCategory::where('cat_type', 1)->where('top_menu', 1)->where('status', 1)->where('deletable', 1)->orderBy('cat_position')->get();
        return response()->json($allCat, 200);
    }

    public function homePopularPosts(){
        $contents = BnContent::with('category', 'subcategory')
            ->where('status', 1)
            ->where('deletable', 1)
            ->where('created_at', '>', now()->subDays(3)->endOfDay())
            ->orderBy('total_hit', 'desc')
            ->take(20)
            ->get();
        return response()->json($contents, 200);
    }

    public function homeLatestPosts(){
        $latestcontent = BnContent::with('category', 'subcategory')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(20)->get();
        return response()->json($latestcontent, 200);
    }


    public function specialTopContents(){

        $position = BnContentPosition::query()
            ->select(['position_id', 'position_name', 'cat_id', 'special_cat_id', 'subcat_id', 'content_ids', 'total_content'])
            ->where('position_id', 1)
            ->where('status', 1)
            ->where('deletable', 1)
            ->first();

        if ($position && $position->content_ids) {
            $aContentIDs = explode(",", $position->content_ids);
            $aContentIDs = array_slice($aContentIDs, 0, $position->total_content);
            $sContentIDs = implode(',', $aContentIDs);
            $specialContent = BnContent::with('category', 'subcategory')->whereIn('content_id', $aContentIDs)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $sContentIDs)")->get();
            return response()->json($specialContent, 200);
        }

    }

    public function homeNationalPositionContent(){

        $position = BnContentPosition::query()
            ->select(['position_id', 'position_name', 'cat_id', 'special_cat_id', 'subcat_id', 'content_ids', 'total_content'])
            ->where('cat_id', 1)
            ->where('status', 1)
            ->where('deletable', 1)
            ->first();

        if ($position && $position->content_ids) {
            $aContentIDs = explode(",", $position->content_ids);
            $aContentIDs = array_slice($aContentIDs, 0, $position->total_content);
            $sContentIDs = implode(',', $aContentIDs);
            $national = BnContent::with('category', 'subcategory')->whereIn('content_id', $aContentIDs)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $sContentIDs)")->get();
            return response()->json($national, 200);
        }

    }

    public function homePoliticsContent(){

        $politicsContents = BnContent::with('category', 'subcategory')->where('cat_id', 2)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(6)->get();
        return response()->json($politicsContents, 200);

    }

    public function homeEconomyContent(){

        $economyContents = BnContent::with('category', 'subcategory')->where('cat_id', 3)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(6)->get();
        return response()->json($economyContents, 200);

    }

    public function homeInternationalContent(){

        $economyContents = BnContent::with('category', 'subcategory')->where('cat_id', 4)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(6)->get();
        return response()->json($economyContents, 200);

    }

    public function homeSpecialReport(){
        $specialReport = BnContent::with('category', 'subcategory')->where('cat_id', 30)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(4)->get();
        return response()->json($specialReport, 200);
    }

    public function homeSportsPositionContent(){

        $position = BnContentPosition::query()
            ->select(['position_id', 'position_name', 'cat_id', 'special_cat_id', 'subcat_id', 'content_ids', 'total_content'])
            ->where('cat_id', 5)
            ->where('status', 1)
            ->where('deletable', 1)
            ->first();

        if ($position && $position->content_ids) {
            $aContentIDs = explode(",", $position->content_ids);
            $aContentIDs = array_slice($aContentIDs, 0, $position->total_content);
            $sContentIDs = implode(',', $aContentIDs);
            $national = BnContent::with('category', 'subcategory')->whereIn('content_id', $aContentIDs)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $sContentIDs)")->get();
            return response()->json($national, 200);
        }

    }


    public function homeSaradeshPositionContent(){

        $position = BnContentPosition::query()
            ->select(['position_id', 'position_name', 'cat_id', 'special_cat_id', 'subcat_id', 'content_ids', 'total_content'])
            ->where('cat_id', 16)
            ->where('status', 1)
            ->where('deletable', 1)
            ->first();

        if ($position && $position->content_ids) {
            $aContentIDs = explode(",", $position->content_ids);
            $aContentIDs = array_slice($aContentIDs, 0, $position->total_content);
            $sContentIDs = implode(',', $aContentIDs);
            $national = BnContent::with('category', 'subcategory')->whereIn('content_id', $aContentIDs)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $sContentIDs)")->take(4)->get();
            return response()->json($national, 200);
        }

    }

    public function homeEntertainmentPositionContent(){

        $position = BnContentPosition::query()
            ->select(['position_id', 'position_name', 'cat_id', 'special_cat_id', 'subcat_id', 'content_ids', 'total_content'])
            ->where('cat_id', 6)
            ->where('status', 1)
            ->where('deletable', 1)
            ->first();

        if ($position && $position->content_ids) {
            $aContentIDs = explode(",", $position->content_ids);
            $aContentIDs = array_slice($aContentIDs, 0, $position->total_content);
            $sContentIDs = implode(',', $aContentIDs);
            $national = BnContent::with('category', 'subcategory')->whereIn('content_id', $aContentIDs)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $sContentIDs)")->take(5)->get();
            return response()->json($national, 200);
        }

    }

    public function homeLawCourtContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 14)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeLifestyleContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 9)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(4)->get();
        return response()->json($contents, 200);
    }


    public function homeCrimeContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 33)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(4)->get();
        return response()->json($contents, 200);
    }

    public function homeTechnologyContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 7)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeCareerPositionContent(){

        $position = BnContentPosition::query()
            ->select(['position_id', 'position_name', 'cat_id', 'special_cat_id', 'subcat_id', 'content_ids', 'total_content'])
            ->where('cat_id', 12)
            ->where('status', 1)
            ->where('deletable', 1)
            ->first();

        if ($position && $position->content_ids) {
            $aContentIDs = explode(",", $position->content_ids);
            $aContentIDs = array_slice($aContentIDs, 0, $position->total_content);
            $sContentIDs = implode(',', $aContentIDs);
            $national = BnContent::with('category', 'subcategory')->whereIn('content_id', $aContentIDs)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $sContentIDs)")->take(8)->get();
            return response()->json($national, 200);
        }

    }

    public function homeCampusContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 26)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(8)->get();
        return response()->json($contents, 200);
    }

    public function homeArtsContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 43)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeHealthContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 10)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeReligionContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 17)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeEducationContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 11)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeChildrenContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 27)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeMotivationContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 28)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeProbashContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 23)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeCorporateContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 36)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeLiteratureContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 8)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeOpinionContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 21)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(5)->get();
        return response()->json($contents, 200);
    }

    public function homeSpecialArticleContent(){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', 25)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take(7)->get();
        return response()->json($contents, 200);
    }

    public function homeGallery(){
        $contents = collect();

            $position = PhotoAlbumPosition::query()
                ->select(['position_id', 'position_name', 'cat_id', 'special_cat_id', 'subcat_id', 'content_ids', 'total_content'])
                ->where('position_id', 1)
                ->where('status', 1)
                ->where('deletable', 1)
                ->first();
            if ($position && $position->content_ids) {
                $aContentIDs = explode(",", $position->content_ids);
                $aContentIDs = array_slice($aContentIDs, 0, $position->total_content);
                $sContentIDs = implode(',', $aContentIDs);
                $contents = PhotoAlbum::with('category')->whereIn('album_id', $aContentIDs)->where('deletable', 1)->orderByRaw("FIELD(album_id, $sContentIDs)")->get();

            }

        return response()->json($contents, 200);

    }





    public function detailsPageFirstRelatedContent($contentId){
        // First Details content
        $firstRelatedContent = BnContent::with('category', 'subcategory')
            ->where('content_id', '<>', $contentId)
            //->where('cat_id', $detailsContent->cat_id)
            ->where('status', 1)
            ->where('deletable', 1)
            ->orderByDesc('content_id')
            ->take(5)
            ->get();


        return response()->json($firstRelatedContent,200);

    }

    public function detailCategoryWisePost($cat_id, $contentId){
        $moreContents = BnContent::with('category', 'subcategory')
            ->where('cat_id', $cat_id)
            ->where('content_id', '<>', $contentId)
            ->where('status', 1)
            ->where('deletable', 1)
            ->latest()
            ->take(5)
            ->get();
        return response()->json($moreContents,200);
    }


    public function relatedContentBelow(Request $request){
        $content = BnContent::with('category', 'subcategory')
            //->whereNotIn('content_id', [$detailsContent->content_id])
            ->whereNotIn('content_id', $request->readedIds)
            ->where('content_id','<>', $request->detailId)
            ->where('status', 1)
            ->where('deletable', 1)
            ->orderByDesc('content_id')
            ->take(5)
            ->get();
        return response()->json($content,200);
    }

    public function insideMoreDetailsPostExcept(Request $request){
        $content = BnContent::with('category:cat_id,cat_slug', 'subcategory:subcat_id,subcat_slug')
            ->select(['content_id', 'cat_id', 'subcat_id', 'content_heading', 'img_xs_path'])
            // ->whereRaw('FIND_IN_SET(?, tags)', $tags[0])
            //->where('content_id', '<>', $dcontent->content_id)
            ->whereNotIn('content_id', [$request->currentPostDetailId, $request->morePostId])
            ->where('cat_id', $request->cat_id)
            ->where('status', 1)
            ->where('deletable', 1)
            ->orderByDesc('content_id')
            ->limit(5)
            ->get();
        return response()->json($content,200);
    }


    public function categoryContent($catSlug, $take){
        $category = BnCategory::with('subcat')->where('cat_slug', $catSlug)->where('status', 1)->where('deletable', 1)->first();

        if(is_null($category)){
            abort(404);
        }

        $catId = $category->cat_id;

        $contents = BnHelperController::getCategoryContent($catId, $take, false);

        $randomCatId = rand(1,20);
        if ($randomCatId == $catId) {
            $randomCatId = rand(1,20);
        }
        $otherCatContents = BnHelperController::getCategoryContent($randomCatId, 5, false);

//        return view("frontend.bn.category", compact('category', 'contents', 'otherCatContents'));

        return response()->json([
            'category' => $category,
            'contents' => $contents,
            'otherCatContents' => $otherCatContents
        ], 200);

    }

    public function tagContent($tagSlug, $take){
        $tag = BnTag::where('tag_slug', $tagSlug)->where('deletable', 1)->first();
//        if(is_null($tag)){
//            abort(404);
//        }

        $contents = BnHelperController::getTagContent($tagSlug, $take, false);
        return response()->json($contents, 200);

    }

    public function subcategoryContent($catSlug, $subcatSlug, $take){

        $category = BnCategory::with('subcat')->select('cat_id', 'cat_name', 'cat_name_bn', 'cat_slug', 'cat_title')->where('cat_slug', $catSlug)->where('status', 1)->where('deletable', 1)->first();

        if (is_null($category)) abort(404);

        $subcategory = BnSubcategory::select('subcat_id', 'cat_id', 'subcat_name', 'subcat_name_bn', 'subcat_slug')->where('cat_id', $category->cat_id)->where('subcat_slug', $subcatSlug)->where('status', 1)->where('deletable', 1)->first();

        if (is_null($subcategory)) abort(404);

        $contents = BnContent::with('category', 'subcategory')->where('cat_id', $category->cat_id)->where('subcat_id', $subcategory->subcat_id)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->limit($take) ->get();

//        $latestContents = BnHelperController::getLatestContent(5);
//        $popularContents = BnHelperController::getPopularContent(5);
        $randomCatId = rand(1,20);
        if ($randomCatId == $category->cat_id) {
            $randomCatId = rand(1,20);
        }
        $otherCatContents = BnHelperController::getCategoryContent($randomCatId, 5);

        return response()->json([
            'category' => $category,
            'subcategory' => $subcategory,
            'contents' => $contents,
            'otherCatContents' => $otherCatContents
        ], 200);

    }


    public function archive(Request $request) {
//        date('Y-m-d H:i:s', strtotime($request->date))
        if ($request->date){
            $contents = BnContent::with('category', 'subcategory')->where('created_at',  'like', '%'.date('Y-m-d', strtotime($request->date)).'%')->orderBy('content_id', 'DESC')->limit($request->take)->get();
            return response()->json($contents, 200);
        }else{
            $contents = BnContent::with('category', 'subcategory')->orderBy('content_id', 'DESC')->limit($request->take)->get();
            return response()->json($contents, 200);
        }

    }


    public function menuLatestPost(Request $request){
        $latestcontent = BnContent::with('category', 'subcategory')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->take($request->take)->get();
        return response()->json($latestcontent, 200);
    }

    public function authorContent(Request $request){
        $author = BnAuthor::where('author_slug', $request->author_slug)->where('deletable', 1)->first();
//        if(is_null($author)){
//            abort(404);
//        }
        $contents = BnHelperController::getAuthorContent($request->author_slug, $request->take, false);

        return response()->json([
                'author' => $author,
                'content' => $contents
        ], 200);
    }



    public function getOG(Request $request)
    {
        $items = request()->all();

        if (empty($items['amp;imgPath']) && empty($items['imgPath'])) {
            abort(404);
        } elseif (!empty($items['amp;imgPath'])) {
            $imgPath = $items['amp;imgPath'];
        } else {
            $imgPath = $items['imgPath'];
        }

        // Type - if type is video or photo
        if (!empty($items['amp;type'])) {
            $type = $items['amp;type'];
        } elseif(!empty($items['type'])) {
            $type = $items['type'];
        } else {
            // if type is none, it will set content image path
            $type = null;
        }

        if (!$imgPath) abort(404);

        $watermarkFile = '/media/ogImages/og-common.png';
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
        imagejpeg($img);

        imagedestroy($img);
    }



}


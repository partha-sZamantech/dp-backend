<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\Bn\BnHelperController;
use App\Http\Controllers\Backend\Photo\PhotoHelperController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\En\EnHelperController;
use App\Http\Services\Bn\BnBreakingNewsService;
use App\Http\Services\Bn\BnContentService;
use App\Http\Services\Bn\BnVideoService;
use App\Http\Services\Bn\ElectionService;
use App\Models\BnAuthor;
use App\Models\BnCategory;
use App\Models\BnContent;
use App\Models\BnContentPosition;
use App\Models\BnPoll;
use App\Models\BnSubcategory;
use App\Models\BnTag;
use App\Models\Epaper;
use App\Models\Magazine;
use App\Models\MagazinePage;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Http\Services\En\EnContentService;

class BnFrontendController extends Controller
{
    public $specialEventContentsCacheKey = 'specialEventContentsCacheKey';
    public $specialArrangementContentsCacheKey = 'specialArrangementContentsCacheKey';
    public $specialTopContentsCacheKey = 'specialTopContentsCacheKey';
    public $electionSpecialContentsCacheKey = 'electionSpecialContentsCacheKey';
    public $latestContentsCacheKey = 'latestContentsCacheKey';
    public $popularContentsCacheKey = 'popularContentsCacheKey';
    public $englishContentsCacheKey = 'englishContentsCacheKey';
    public $rajdhaniContentsCacheKey = 'rajdhaniContentsCacheKey';
    public $specialReportContentsCacheKey = 'specialReportContentsCacheKey';
    public $nationalContentsCacheKey = 'nationalContentsCacheKey';
    public $politicsContentsCacheKey = 'politicsContentsCacheKey';
    public $economyContentsCacheKey = 'economyContentsCacheKey';
    public $internationalContentsCacheKey = 'internationalContentsCacheKey';
    public $sportsContentsCacheKey = 'sportsContentsCacheKey';
    public $healthContentsCacheKey = 'healthContentsCacheKey';
    public $lifestyleContentsCacheKey = 'lifestyleContentsCacheKey';
    public $artCulContentsCacheKey = 'artCulContentsCacheKey';
    public $technologyContentsCacheKey = 'technologyContentsCacheKey';
    public $educationContentsCacheKey = 'educationContentsCacheKey';
    public $entertainmentContentsCacheKey = 'entertainmentContentsCacheKey';
    public $saradeshContentsCacheKey = 'saradeshContentsCacheKey';
    public $literatureContentsCacheKey = 'literatureContentsCacheKey';
    public $opinionContentsCacheKey = 'opinionContentsCacheKey';
    public $religionContentsCacheKey = 'religionContentsCacheKey';
    public $careerContentsCacheKey = 'careerContentsCacheKey';
    public $specialArticleContentsCacheKey = 'specialArticleContentsCacheKey';
    public $campusContentsCacheKey = 'campusContentsCacheKey';
    public $lawContentsCacheKey = 'lawContentsCacheKey';
    public $crimeContentsCacheKey = 'crimeContentsCacheKey';
    public $childrenContentsCacheKey = 'childrenContentsCacheKey';
    public $motivationContentsCacheKey = 'motivationContentsCacheKey';
    public $probashContentsCacheKey = 'probashContentsCacheKey';
    public $corporateContentsCacheKey = 'corporateContentsCacheKey';
    public $homePhotoGalleryCacheKey = 'homePhotoGalleryCacheKey';


    public function index(){
        // Breaking news - it comes from caching
        $breakingContents = (new BnBreakingNewsService())->getBreakingNews();

        // Special Event
        $specialEventContents = (new BnContentService())->getPositionContent(2, null, $this->specialEventContentsCacheKey);

        // Election data
        $electionData = (new ElectionService())->getElectionData();

        // Special event news
        $specialArrangementContents = (new BnContentService())->getPositionContent(3, null, $this->specialArrangementContentsCacheKey);

        // Special Event videos - it comes from caching
        $bnSpecialEventVideos = (new BnVideoService())->getBnSpecialEventVideos();

        // Special top videos - it comes from caching
        $bnSpecialTopVideos = (new BnVideoService())->getBnSpecialTopVideos();

        // Special Top Contents
        $specialTopContents = (new BnContentService())->getPositionContent(1, null, $this->specialTopContentsCacheKey);


        // Latest contents
        if (!Cache::has($this->latestContentsCacheKey)) {
            $latestContents = BnHelperController::getLatestContent(10);
            Cache::forever($this->latestContentsCacheKey, $latestContents);
        } else {
            $latestContents = Cache::get($this->latestContentsCacheKey);
        }

        // Popular contents
        if (!Cache::has($this->popularContentsCacheKey)) {
            $popularContents = BnHelperController::getPopularContent(10);
            Cache::forever($this->popularContentsCacheKey, $popularContents);
        } else {
            $popularContents = Cache::get($this->popularContentsCacheKey);
        }

        // English content
        $englishContents = (new EnContentService())->getPositionContent(1);
//        if (!Cache::has($this->englishContentsCacheKey)) {
//            $englishContents = EnHelperController::getLatestContent(7);
//            Cache::forever($this->englishContentsCacheKey, $englishContents);
//        } else {
//            $englishContents = Cache::get($this->englishContentsCacheKey);
//        }

        // Rajdhani contents
        if (!Cache::has($this->rajdhaniContentsCacheKey)) {
            $rajdhaniContents = BnHelperController::getCategoryContent(19, 6);
            Cache::forever($this->rajdhaniContentsCacheKey, $rajdhaniContents);
        } else {
            $rajdhaniContents = Cache::get($this->rajdhaniContentsCacheKey);
        }

        // Special report contents
        if (!Cache::has($this->specialReportContentsCacheKey)) {
            $specialReportContents = BnHelperController::getCategoryContent(30, 4);
            Cache::forever($this->specialReportContentsCacheKey, $specialReportContents);
        } else {
            $specialReportContents = Cache::get($this->specialReportContentsCacheKey);
        }

        // National Contents
        $nationalContents = (new BnContentService())->getPositionContent(4, 1, $this->nationalContentsCacheKey);

        // Politics Content
//        if (!Cache::has($this->politicsContentsCacheKey)) {
//            $politicsContents = BnHelperController::getCategoryContent(2, 5);
//            Cache::forever($this->politicsContentsCacheKey, $politicsContents);
//        } else {
//            $politicsContents = Cache::get($this->politicsContentsCacheKey);
//        }
        $politicsContents = (new BnContentService())->getPositionContent(null, 2, $this->politicsContentsCacheKey);

        // Economy Content
        $economyContents = (new BnContentService())->getPositionContent(null, 3, $this->economyContentsCacheKey);

        // International Content
        $internationalContents = (new BnContentService())->getPositionContent(null, 4, $this->internationalContentsCacheKey);

        // Sports Content
        $sportsContents = (new BnContentService())->getPositionContent(null, 5, $this->sportsContentsCacheKey);

        // Health Content
        if (!Cache::has($this->healthContentsCacheKey)) {
            $healthContents = BnHelperController::getCategoryContent(10, 5);
            Cache::forever($this->healthContentsCacheKey, $healthContents);
        } else {
            $healthContents = Cache::get($this->healthContentsCacheKey);
        }

        // Lifestyle Content
        if (!Cache::has($this->lifestyleContentsCacheKey)) {
            $lifestyleContents = BnHelperController::getCategoryContent(9, 4);
            Cache::forever($this->lifestyleContentsCacheKey, $lifestyleContents);
        } else {
            $lifestyleContents = Cache::get($this->lifestyleContentsCacheKey);
        }

        // Art & Culture Content
        if (!Cache::has($this->artCulContentsCacheKey)) {
            $artCulContents = BnHelperController::getCategoryContent(43, 5);
            Cache::forever($this->artCulContentsCacheKey, $artCulContents);
        } else {
            $artCulContents = Cache::get($this->artCulContentsCacheKey);
        }

        // Technology Content
        if (!Cache::has($this->technologyContentsCacheKey)) {
            $technologyContents = BnHelperController::getCategoryContent(7, 5);
            Cache::forever($this->technologyContentsCacheKey, $technologyContents);
        } else {
            $technologyContents = Cache::get($this->technologyContentsCacheKey);
        }

        // Education Content
        if (!Cache::has($this->educationContentsCacheKey)) {
            $educationContents = BnHelperController::getCategoryContent(11, 5);
            Cache::forever($this->educationContentsCacheKey, $educationContents);
        } else {
            $educationContents = Cache::get($this->educationContentsCacheKey);
        }

        // Entertainment Content
        if (!Cache::has($this->entertainmentContentsCacheKey)) {
//            $educationContents = BnHelperController::getCategoryContent(6, 5);
            $entertainmentContents = (new BnContentService())->getPositionContent(null, 6, $this->entertainmentContentsCacheKey);
            Cache::forever($this->entertainmentContentsCacheKey, $entertainmentContents);
        } else {
            $entertainmentContents = Cache::get($this->entertainmentContentsCacheKey);
        }

        // Saradesh Content
//        $saradeshContents = (new BnContentService())->getPositionContent(null, 16, $this->saradeshContentsCacheKey);
        $saradeshContents = [];

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
                $saradeshContents = BnContent::with('category', 'subcategory')->whereIn('content_id', $aContentIDs)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $sContentIDs)")->take(3)->get();

            }





        // Literature Content
        if (!Cache::has($this->literatureContentsCacheKey)) {
            $literatureContents = BnHelperController::getCategoryContent(8, 5);
            Cache::forever($this->literatureContentsCacheKey, $literatureContents);
        } else {
            $literatureContents = Cache::get($this->literatureContentsCacheKey);
        }

        // Opinion Content
        if (!Cache::has($this->opinionContentsCacheKey)) {
            $opinionContents = BnHelperController::getCategoryContent(21, 7);
            Cache::forever($this->opinionContentsCacheKey, $opinionContents);
        } else {
            $opinionContents = Cache::get($this->opinionContentsCacheKey);
        }

        // Religion Content
        if (!Cache::has($this->religionContentsCacheKey)) {
            $religionContents = BnHelperController::getCategoryContent(17, 5);
            Cache::forever($this->religionContentsCacheKey, $religionContents);
        } else {
            $religionContents = Cache::get($this->religionContentsCacheKey);
        }

        // Career Content
        if (!Cache::has($this->careerContentsCacheKey)) {
//            $careerContents = BnHelperController::getCategoryContent(12, 7);
            $careerContents = (new BnContentService())->getPositionContent(null, 12, $this->careerContentsCacheKey);
            Cache::forever($this->careerContentsCacheKey, $careerContents);
        } else {
            $careerContents = Cache::get($this->careerContentsCacheKey);
        }

        // Special Article Content
        if (!Cache::has($this->specialArticleContentsCacheKey)) {
            $specialArticleContents = BnHelperController::getCategoryContent(25, 7);
            Cache::forever($this->specialArticleContentsCacheKey, $specialArticleContents);
        } else {
            $specialArticleContents = Cache::get($this->specialArticleContentsCacheKey);
        }

        // Campus Content
        if (!Cache::has($this->campusContentsCacheKey)) {
            $campusContents = BnHelperController::getCategoryContent(26, 7);
            Cache::forever($this->campusContentsCacheKey, $campusContents);
        } else {
            $campusContents = Cache::get($this->campusContentsCacheKey);
        }

        // Law and Court Content
        if (!Cache::has($this->lawContentsCacheKey)) {
            $lawContents = BnHelperController::getCategoryContent(14, 5);
            Cache::forever($this->lawContentsCacheKey, $lawContents);
        } else {
            $lawContents = Cache::get($this->lawContentsCacheKey);
        }

        // Crime Content
        if (!Cache::has($this->crimeContentsCacheKey)) {
            $crimeContents = BnHelperController::getCategoryContent(33, 4);
            Cache::forever($this->crimeContentsCacheKey, $crimeContents);
        } else {
            $crimeContents = Cache::get($this->crimeContentsCacheKey);
        }

        // Children Content
        if (!Cache::has($this->childrenContentsCacheKey)) {
            $childrenContents = BnHelperController::getCategoryContent(27, 5);
            Cache::forever($this->childrenContentsCacheKey, $childrenContents);
        } else {
            $childrenContents = Cache::get($this->childrenContentsCacheKey);
        }

        // Motivation Content
        if (!Cache::has($this->motivationContentsCacheKey)) {
            $motivationContents = BnHelperController::getCategoryContent(28, 5);
            Cache::forever($this->motivationContentsCacheKey, $motivationContents);
        } else {
            $motivationContents = Cache::get($this->motivationContentsCacheKey);
        }

        // Probash Content
        if (!Cache::has($this->probashContentsCacheKey)) {
            $probashContents = BnHelperController::getCategoryContent(23, 5);
            Cache::forever($this->probashContentsCacheKey, $probashContents);
        } else {
            $probashContents = Cache::get($this->probashContentsCacheKey);
        }

        // Corporate Content
        if (!Cache::has($this->corporateContentsCacheKey)) {
            $corporateContents = BnHelperController::getCategoryContent(36, 5);
            Cache::forever($this->corporateContentsCacheKey, $corporateContents);
        } else {
            $corporateContents = Cache::get($this->corporateContentsCacheKey);
        }

        //election Special Content
//        $elcetion_content_ids = ['2202', '2203', 2204];
//        $electionSpecialContents = BnContent::whereIn('content_id', $elcetion_content_ids)->get();


        // Photo Gallery
        if (!Cache::has($this->homePhotoGalleryCacheKey)) {
            $photoAlbums = PhotoHelperController::getPositionContent(1, null, $this->homePhotoGalleryCacheKey);
            Cache::forever($this->homePhotoGalleryCacheKey, $photoAlbums);
        } else {
            $photoAlbums = Cache::get($this->homePhotoGalleryCacheKey);
        }

        //Voting polls
        $polls = BnPoll::select('poll_id', 'sm_image_path', 'poll_title', 'yes_vote', 'no_vote', 'no_opinion', 'total_vote')
                        ->where('status', 1)
                        ->where('deletable', 1)
                       ->limit(3)
                       ->latest()
                       ->get();
        Carbon::setLocale('bn');

//        $nibachonContent = BnHelperController::getTagContent('জাতীয়-নির্বাচন', 4, false);
        $nibachonContent = (new BnContentService())->getPositionContent(12, null, $this->electionSpecialContentsCacheKey);

        return view('frontend.bn.home-new', compact('bnSpecialEventVideos', 'specialArrangementContents', 'polls', 'specialEventContents', 'breakingContents', 'bnSpecialTopVideos','specialTopContents', 'latestContents', 'popularContents', 'englishContents', 'rajdhaniContents', 'specialReportContents', 'nationalContents', 'politicsContents', 'economyContents', 'internationalContents', 'artCulContents', 'lifestyleContents', 'sportsContents', 'healthContents', 'technologyContents', 'educationContents', 'literatureContents', 'saradeshContents', 'entertainmentContents', 'opinionContents', 'religionContents', 'careerContents', 'specialArticleContents', 'campusContents', 'lawContents', 'crimeContents', 'photoAlbums', 'childrenContents', 'motivationContents', 'probashContents', 'corporateContents', 'electionData', 'nibachonContent'));
    }

    public function clearHomePageContentCache(){
        Cache::forget($this->specialEventContentsCacheKey);
        Cache::forget($this->specialArrangementContentsCacheKey);
        Cache::forget($this->specialTopContentsCacheKey);
        Cache::forget($this->electionSpecialContentsCacheKey);
        Cache::forget($this->latestContentsCacheKey);
        Cache::forget($this->popularContentsCacheKey);
//        Cache::forget($this->englishContentsCacheKey);
        Cache::forget($this->rajdhaniContentsCacheKey);
        Cache::forget($this->specialReportContentsCacheKey);
        Cache::forget($this->nationalContentsCacheKey);
        Cache::forget($this->politicsContentsCacheKey);
        Cache::forget($this->economyContentsCacheKey);
        Cache::forget($this->internationalContentsCacheKey);
        Cache::forget($this->sportsContentsCacheKey);
        Cache::forget($this->healthContentsCacheKey);
        Cache::forget($this->lifestyleContentsCacheKey);
        Cache::forget($this->artCulContentsCacheKey);
        Cache::forget($this->technologyContentsCacheKey);
        Cache::forget($this->educationContentsCacheKey);
        Cache::forget($this->entertainmentContentsCacheKey);
        Cache::forget($this->saradeshContentsCacheKey);
        Cache::forget($this->literatureContentsCacheKey);
        Cache::forget($this->opinionContentsCacheKey);
        Cache::forget($this->religionContentsCacheKey);
        Cache::forget($this->careerContentsCacheKey);
        Cache::forget($this->specialArticleContentsCacheKey);
        Cache::forget($this->campusContentsCacheKey);
        Cache::forget($this->lawContentsCacheKey);
        Cache::forget($this->crimeContentsCacheKey);
        Cache::forget($this->childrenContentsCacheKey);
        Cache::forget($this->probashContentsCacheKey);
        Cache::forget($this->corporateContentsCacheKey);
        Cache::forget($this->motivationContentsCacheKey);
        Cache::forget($this->homePhotoGalleryCacheKey);

        return true;
    }

    public function categoryContent($catSlug){
        $category = BnCategory::with('subCategories')->where('cat_slug', $catSlug)->where('status', 1)->where('deletable', 1)->first();

        if(is_null($category)){
            abort(404);
        }

        $catId = $category->cat_id;

        $contents = BnHelperController::getCategoryContent($catId, 15, true);

        $randomCatId = rand(1,20);
        if ($randomCatId == $catId) {
            $randomCatId = rand(1,20);
        }
        $otherCatContents = BnHelperController::getCategoryContent($randomCatId, 5);

        return view("frontend.bn.category", compact('category', 'contents', 'otherCatContents'));
    }

    public function latestPostContents(){
//        $category = BnCategory::with('subCategories')->where('cat_slug', $catSlug)->where('status', 1)->where('deletable', 1)->first();
//
//        if(is_null($category)){
//            abort(404);
//        }
//
//        $catId = $category->cat_id;

        $contents = BnContent::with('category', 'subcategory')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(15);



            $randomCatId = rand(1,20);

        $otherCatContents = BnHelperController::getCategoryContent($randomCatId, 5);

        return view("frontend.bn.latest-post", compact('contents', 'otherCatContents'));

    }

    public function subcategoryContent($cat, $subcat){

        $category = BnCategory::with('subCategories')->select('cat_id', 'cat_name', 'cat_name_bn', 'cat_slug', 'cat_title')->where('cat_slug', $cat)->where('status', 1)->where('deletable', 1)->first();

        if (is_null($category)) abort(404);

        $subcategory = BnSubcategory::select('subcat_id', 'cat_id', 'subcat_name', 'subcat_name_bn', 'subcat_slug')->where('cat_id', $category->cat_id)->where('subcat_slug', $subcat)->where('status', 1)->where('deletable', 1)->first();

        if (is_null($subcategory)) abort(404);

        $contents = BnContent::with('category', 'subcategory')->where('cat_id', $category->cat_id)->where('subcat_id', $subcategory->subcat_id)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(15);

//        $latestContents = BnHelperController::getLatestContent(5);
//        $popularContents = BnHelperController::getPopularContent(5);
        $randomCatId = rand(1,20);
        if ($randomCatId == $category->cat_id) {
            $randomCatId = rand(1,20);
        }
        $otherCatContents = BnHelperController::getCategoryContent($randomCatId, 5);

        return view('frontend.bn.subcategory', compact('category', 'subcategory', 'contents', 'otherCatContents'));

    }

    public function details($catSlug, $contentType, $contentId)
    {

        if (!is_numeric($contentId)) abort(404);

        $detailsContent = BnContent::with('category', 'subcategory')->where('content_id', $contentId)->where('status', 1)->where('deletable', 1)->first();
        if (!$detailsContent) abort(404);

        BnContent::where('content_id', $contentId)->increment('total_hit');

        // ================= Original InsideMoreNews ===============
//        $insideMoreNews = [];
//        if ($detailsContent->tags) {
//            $tags = explode(',', $detailsContent->tags);
//
//            if (count($tags)) {
//                $insideMoreNews = BnContent::with('category:cat_id,cat_slug', 'subcategory:subcat_id,subcat_slug')
//                    ->select(['content_id', 'cat_id', 'subcat_id', 'content_heading', 'img_xs_path'])
//                    ->whereRaw('FIND_IN_SET(?, tags)', $tags[0])
//                    ->where('content_id', '<>', $contentId)
//                    ->where('status', 1)
//                    ->where('deletable', 1)
//                    ->latest()
//                    ->limit(5)
//                    ->get();
//            }
//        }
        // ================= Original InsideMoreNews ===============
        $getCategory = BnCategory::where('cat_slug', $catSlug)->first();
        $insideMoreNews = BnContent::with('category:cat_id,cat_slug', 'subcategory:subcat_id,subcat_slug')
            ->select(['content_id', 'cat_id', 'subcat_id', 'content_heading', 'img_xs_path'])
            // ->whereRaw('FIND_IN_SET(?, tags)', $tags[0])
            ->where('content_id', '<>', $contentId)
            ->where('cat_id', $getCategory->cat_id)
            ->where('status', 1)
            ->where('deletable', 1)
            ->orderByDesc('content_id')
            ->limit(5)
            ->get();

        $aAuthorSlugs = explode(',', $detailsContent->author_slugs);
        $sAuthorSlugs = "'" . implode("','",$aAuthorSlugs) . "'";

        $authors = BnAuthor::query()
            ->select(['author_name_bn', 'author_slug', 'img_path'])
            ->whereIn('author_slug', $aAuthorSlugs)
            ->where('deletable', 1)
            ->orderByRaw("FIELD(author_slug, $sAuthorSlugs)")
            ->get();

        $moreContents = BnContent::with('category', 'subcategory')
            ->where('cat_id', $detailsContent->cat_id)
            ->where('content_id', '<>', $contentId)
            ->where('status', 1)
            ->where('deletable', 1)
            ->latest()
            ->take(5)
            ->get();

        $moreDetailContent = BnContent::with('category', 'subcategory')
            ->where('content_id', '<>', $contentId)
            ->where('status', 1)
            ->where('deletable', 1)
            ->orderBy('content_id', 'DESC')
            ->take(3)
            ->get();

        /*$relatedContents = '';
        if ($detailsContent->related_ids){
            $aRelIds = explode(',', $detailsContent->related_ids);
            $relatedContents = BnContent::with('category', 'subcategory')->whereIn('content_id', $aRelIds)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $detailsContent->related_ids)")->get();
        }*/
//         Main Related query 20
        $allLatestPost = BnContent::with('category', 'subcategory')
            ->where('status', 1)
            ->where('deletable', 1)
            ->orderBy('content_id', 'DESC')
            ->take(20)
            ->get();

        $relatedContents = BnContent::with('category', 'subcategory')
            ->where('content_id', '<>', $contentId)
            ->where('status', 1)
            ->where('deletable', 1)
            ->latest()
            ->take(8)
            ->get();

//        $latestContents = BnHelperController::getLatestContent(10);
//        $popularContents = BnHelperController::getPopularContent(10);

        return view('frontend.bn.details', compact('detailsContent', 'authors', 'insideMoreNews', 'relatedContents'/*, 'latestContents', 'popularContents'*/, 'moreContents','moreDetailContent', 'allLatestPost'));
    }

    public function tagContent($tagSlug){
        $tag = BnTag::where('tag_slug', $tagSlug)->where('deletable', 1)->first();
        if(is_null($tag)){
            abort(404);
        }

        $contents = BnHelperController::getTagContent($tagSlug, 15, true);

        return view("frontend.bn.tag", compact('tag', 'contents'));
    }

    public function authorContent($authorSlug){
        $author = BnAuthor::where('author_slug', $authorSlug)->where('deletable', 1)->first();
        if(is_null($author)){
            abort(404);
        }

        $contents = BnHelperController::getAuthorContent($authorSlug, 15, true);

        return view("frontend.bn.author", compact('author', 'contents'));
    }

    public function archive(){
        $catId = trim(request()->cat);
        $dateFrom = trim(request()->dateFrom);
        $dateTo = trim(request()->dateTo);
        $keyword = trim(request()->keyword);

        $contents = BnContent::with('category', 'subcategory');

        if ($catId) $contents = $contents->where('cat_id', $catId);

        if ($dateFrom && $dateTo) $contents = $contents->whereBetween('created_at', [$dateFrom.' 00:00:00', $dateTo.' 23:59:59']);

//        if ($dateTo) $contents = $contents->where('created_at', 'like', $dateTo.'%');

        if ($keyword) $contents = $contents->where('content_heading', 'like', '%'.$keyword.'%');

        $contents = $contents->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(20);

        $categories = BnCategory::select('cat_id', 'cat_name', 'cat_name_bn')->where('deletable', 1)->where('status', 1)->get();

        $latestContents = BnHelperController::getLatestContent();
        $popularContents = BnHelperController::getPopularContent();
        return view('frontend.bn.archive', compact('categories', 'contents', 'latestContents', 'popularContents', 'catId', 'dateFrom', 'dateTo', 'keyword'));
    }

    public function getEpaper($date) {
        // =========== main Code ==============
//        $epaper = Epaper::query()->with('pages:id,epaper_id,img_thumb_path,page_no')->select(['id', 'paper_date', 'meta_keywords', 'meta_description', 'og_img_path'])->where('paper_date', Carbon::now()->toDateString())->where('status', 1)->where('deletable', 1)->first();
        // =========== main Code ==============
        $epaper = Epaper::query()->with('pages:id,epaper_id,img_thumb_path,page_no')->select(['id', 'paper_date', 'meta_keywords', 'meta_description', 'og_img_path'])->where('paper_date', date("Y-m-d", strtotime($date)))->where('status', 1)->where('deletable', 1)->first();

//        if (!$epaper) {
//            $epaper = Epaper::query()->with('pages:id,epaper_id,img_thumb_path,page_no')->select(['id', 'paper_date', 'meta_keywords', 'meta_description', 'og_img_path'])->where('paper_date', now()->subDay()->format('Y-m-d'))->where('status', 1)->where('deletable', 1)->first();
//        }

        if (!$epaper) abort(404);

        return view("frontend.bn.epaper", compact('epaper'));
    }

    public function getMagazines() {
        $magazine = Magazine::query()->with('pages:id,magazine_id,img_thumb_path,counter')->select(['id', 'name', 'meta_keywords', 'meta_description', 'og_img_path'])->where('status', 1)->where('deletable', 1)->first();

        return view("frontend.bn.magazine", compact('magazine'));
    }

    public function generateSitemap(){
        $contents = BnHelperController::getLatestContent(200);

        $sData = '<?xml version="1.0" encoding="UTF-8"?>
                    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';

        foreach ($contents as $content){
            $sHeading=$content->content_heading;
            $sCategoryNameBN=strip_tags($content->category->cat_name_bn);
            $sURL=fDesktopURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type);
            //Date Time
            $timestamp=date('Y-m-d\TH:i:sP', strtotime($content->created_at));
            $sData .= "<url>
                            <loc>$sURL</loc>
                            <news:news>
                                <news:publication>
                                <news:name>ঢাকা প্রকাশ</news:name>
                                <news:language>bn</news:language>
                                </news:publication>
                                <news:publication_date>$timestamp</news:publication_date>
                                <news:title>$sHeading</news:title>
                                <news:keywords>$sCategoryNameBN</news:keywords>
                            </news:news>
                        </url>";
        }

        $sData .= '</urlset>';

        return response($sData)->header('Content-Type', 'text/xml');
    }

    public function contact() {
        // Latest contents
        $latestContents = BnHelperController::getLatestContent(4);

        return view('frontend.common.contact_us', compact('latestContents'));

    }
}


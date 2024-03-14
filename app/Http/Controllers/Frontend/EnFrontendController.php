<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\Bn\BnHelperController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\En\EnHelperController;
use App\Http\Services\Bn\BnContentService;
use App\Http\Services\Bn\BnVideoService;
use App\Http\Services\En\EnBreakingNewsService;
use App\Http\Services\En\EnContentService;
use App\Http\Services\En\EnVideoService;
use App\Models\District;
use App\Models\EnAuthor;
use App\Models\EnCategory;
use App\Models\EnContent;
use App\Models\EnContentPosition;
use App\Models\EnSubcategory;
use App\Models\Division;
use App\Models\Upozilla;

class EnFrontendController extends Controller
{
    public function index()
    {
        // Breaking news
        $breakingContents = (new EnBreakingNewsService())->getBreakingNews();

        // Special top videos
        $enSpecialTopVideos = (new EnVideoService())->getEnSpecialTopVideos();

        // Special Top Contents
        $specialTopContents = (new EnContentService())->getPositionContent(1);

        // Latest & Popular Contents
        $latestContents  = EnHelperController::getLatestContent(10);
        $popularContents = EnHelperController::getPopularContent(10);

        // Bangla Contents
        $bnContents = BnHelperController::getLatestContent();

        // Special Section - it can be tag news or selected news
        $specialSectionContents = (new EnContentService())->getPositionContent(2);

        // National Content
        $nationalContents = (new EnContentService())->getPositionContent(null, 1);
        //$nationalContents = EnHelperController::getCategoryContent(1,5);

        // International Content
        $internationalContents = (new EnContentService())->getPositionContent(null, 4);
        //$internationalContents = EnHelperController::getCategoryContent(4, 5);

        // Politics Content
        $politicsContents = (new EnContentService())->getPositionContent(null, 2);
        //$politicsContents = EnHelperController::getCategoryContent(2,5);
        // Lifestyle Content
        $lifestyleContents = EnHelperController::getCategoryContent(9, 4);

        // Sports Content
        $sportsContents = (new EnContentService())->getPositionContent(null, 5);
        //$sportsContents = EnHelperController::getCategoryContent(5, 5);

        // Health Content
        $healthContents = EnHelperController::getCategoryContent(10, 5);

        // Education Content
        $educationContents = EnHelperController::getCategoryContent(11, 3);

        // Technology Content
        $technologyContents = EnHelperController::getCategoryContent(7, 5);

        // Economy Content
        $economyContents = (new EnContentService())->getPositionContent(null, 3);
        //$economyContents = EnHelperController::getCategoryContent(3, 5);

        // Religion Content
        $religionContents = EnHelperController::getCategoryContent(17, 5);

        // Entertainment Content
        $entertainmentContents = (new EnContentService())->getPositionContent(null, 6);
        //$entertainmentContents = EnHelperController::getCategoryContent(6, 5);

        // Special Content
        $specialContents = EnHelperController::getCategoryContent(18, 5);

        //Opinion Content
        $opinionContents = EnHelperController::getCategoryContent(13,4);

        //literature Content
        $literatureContents = EnHelperController::getCategoryContent(44,3);

        // Special Event videos - it comes from caching
        $bnSpecialEventVideos = (new BnVideoService())->getBnSpecialEventVideos();

        // Special event news
        $specialArrangementContents = (new BnContentService())->getPositionContent(3, null, 'specialArrangementContentsCacheKey');

        return view('frontend.en.home', compact('breakingContents', 'enSpecialTopVideos', 'specialTopContents', 'latestContents', 'popularContents', 'bnContents', 'specialSectionContents', 'nationalContents', 'politicsContents', 'economyContents', 'internationalContents', 'lifestyleContents', 'sportsContents', 'healthContents', 'technologyContents', 'educationContents', 'specialContents', 'entertainmentContents', 'religionContents', 'bnSpecialEventVideos', 'specialArrangementContents', 'opinionContents' , 'literatureContents'));
    }

    public function categoryContent($catSlug)
    {
        $category = EnCategory::where('cat_slug', $catSlug)->where('status', 1)->where('deletable', 1)->first();
        if (is_null($category)) {
            return abort(404);
        }

        $catId = $category->cat_id;

        $latestContents  = EnHelperController::getLatestContent(10);
        $popularContents = EnHelperController::getPopularContent(10);

        $contents = EnHelperController::getCategoryContent($catId, 21, true);

        $otherCatContents = EnHelperController::getCategoryContent(rand(1, 20), 5);

        return view("frontend.en.category", compact('category', 'contents', 'latestContents', 'popularContents', 'otherCatContents'));
    }

    public function subcategoryContent($cat, $subcat)
    {
        $category = EnCategory::select('cat_id', 'cat_name', 'cat_slug', 'cat_title')->where('cat_slug', $cat)->where('status', 1)->where('deletable', 1)->first();

        if (is_null($category)) abort(404);

        $subcategory = EnSubcategory::select('subcat_id', 'cat_id', 'subcat_name', 'subcat_slug')->where('cat_id', $category->cat_id)->where('subcat_slug', $subcat)->where('status', 1)->where('deletable', 1)->first();

        if (is_null($subcategory)) abort(404);

        $latestCatContents = EnContent::with('category', 'subcategory')->where('cat_id', $category->cat_id)->where('subcat_id', $subcategory->subcat_id)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(15);

        $latestContents  = EnHelperController::getLatestContent(5);
        $popularContents = EnHelperController::getPopularContent(5);

        return view('frontend.en.subcategory', compact('category', 'subcategory', 'latestCatContents', 'latestContents', 'popularContents'));
    }

    public function details($catSlug, $contentType, $contentId)
    {
        if (!is_numeric($contentId)) return abort(404);

        EnContent::where('content_id', $contentId)->increment('total_hit');
        $detailsContent = EnContent::with('category')
                                   ->where('content_id', $contentId)
                                   ->where('status', 1)
                                   ->where('deletable', 1)
                                   ->first();

        if (!$detailsContent) return abort(404);

        $author = EnAuthor::where('author_slug', $detailsContent->author_slugs)->where('deletable', 1)->first();

        $moreContents = EnContent::with('category', 'subcategory')
                                 ->where('cat_id', $detailsContent->cat_id)
                                 ->where('content_id', '<>', $contentId)
                                 ->where('status', 1)
                                 ->where('deletable', 1)
                                 ->latest()
                                 ->take(5)
                                 ->get();

//        $relatedContents = '';
//        if ($detailsContent->related_ids) {
//            $aRelIds         = explode(',', $detailsContent->related_ids);
//            $relatedContents = EnContent::with('category', 'subcategory')->whereIn('content_id', $aRelIds)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $detailsContent->related_ids)")->get();
//        }

        $relatedContents = EnContent::with('category', 'subcategory')
                                    ->where('content_id', '<>', $contentId)
                                    ->where('status', 1)
                                    ->where('deletable', 1)
                                    ->latest()
                                    ->take(12)
                                    ->get();

//        $latestContents = EnHelperController::getLatestContent(10);
//        $popularContents = EnHelperController::getPopularContent(10);

        return view('frontend.en.details', compact('detailsContent', 'author', 'relatedContents', /*'latestContents', 'popularContents',*/ 'moreContents'));
    }

    public function archive()
    {
        $catId    = trim(request()->cat);
        $dateFrom = trim(request()->dateFrom);
        $dateTo   = trim(request()->dateTo);
        $keyword  = trim(request()->keyword);

        $contents = EnContent::with('category', 'subcategory');

        if ($catId) $contents = $contents->where('cat_id', $catId);

        if ($dateFrom && $dateTo) $contents = $contents->whereBetween('created_at', [
            $dateFrom . ' 00:00:00', $dateTo . ' 23:59:59'
        ]);

//        if ($dateTo) $contents = $contents->where('created_at', 'like', $dateTo.'%');

        if ($keyword) $contents = $contents->where('content_heading', 'like', '%' . $keyword . '%');

        $contents = $contents->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(20);

        $categories = EnCategory::select('cat_id', 'cat_name')->where('deletable', 1)->where('status', 1)->get();

        $latestContents  = EnHelperController::getLatestContent();
        $popularContents = EnHelperController::getPopularContent();
        return view('frontend.en.archive', compact('categories', 'contents', 'latestContents', 'popularContents', 'catId', 'dateFrom', 'dateTo', 'keyword'));
    }

    public function generateSitemap(){
        $contents = EnHelperController::getLatestContent(200);

        $sData = '<?xml version="1.0" encoding="UTF-8"?>
                    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';

        foreach ($contents as $content){
            $sHeading=$content->content_heading;
            $sCategoryNameEN=strip_tags($content->category->cat_name);
            $sURL=fEnURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type);
            //Date Time
            $timestamp=date('Y-m-d\TH:i:sP', strtotime($content->created_at));
            $sData .= "<url>
                            <loc>$sURL</loc>
                            <news:news>
                                <news:publication>
                                <news:name>Dhaka Prokash</news:name>
                                <news:language>en</news:language>
                                </news:publication>
                                <news:publication_date>$timestamp</news:publication_date>
                                <news:title>$sHeading</news:title>
                                <news:keywords>$sCategoryNameEN</news:keywords>
                            </news:news>
                        </url>";
        }

        $sData .= '</urlset>';

        return response($sData)->header('Content-Type', 'text/xml');
    }

    public function authorContent($authorSlug)
    {
        $author = EnAuthor::where('author_slug', $authorSlug)->where('deletable', 1)->first();
        if (is_null($author)) {
            abort(404);
        }

        $contents = EnHelperController::getAuthorContent($authorSlug, 15, true);

        return view("frontend.en.author", compact('author', 'contents'));
    }

    public function divisionDistrictUpozillaContent($divSlug, $distSlug = null, $upoSlug = null)
    {
        $district = $upozilla = '';
        $contents = EnContent::with('category', 'subcategory', 'comments');
        if ($divSlug) {
            $division = Division::select('division_id', 'division_name', 'division_slug')->where('division_slug', $divSlug)->where('deletable', 1)->first();
            if (is_null($division)) return abort(404);

            $contents = $contents->where('division_id', $division->division_id);
        }

        if ($distSlug) {
            $district = District::select('district_id', 'district_name', 'district_slug')->where('district_slug', $distSlug)->where('deletable', 1)->first();
            if (is_null($district)) return abort(404);

            $contents = $contents->where('district_id', $district->district_id);
        }

        if ($upoSlug) {
            $upozilla = Upozilla::select('upozilla_id', 'upozilla_name', 'upozilla_slug')->where('upozilla_slug', $upoSlug)->where('deletable', 1)->first();
            if (is_null($upozilla)) return abort(404);

            $contents = $contents->where('upozilla_id', $upozilla->upozilla_id);
        }

        $contents = $contents->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->paginate(21);

        $latestContents  = EnHelperController::getLatestContent();
        $popularContents = EnHelperController::getPopularContent();

        return view('frontend.en.div-dis-upz', compact('contents', 'division', 'district', 'upozilla', 'latestContents', 'popularContents'));
    }

}


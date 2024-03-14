<?php

namespace App\Http\Controllers\API\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BnAuthor;
use App\Models\BnCategory;
use App\Models\BnSubcategory;
use Illuminate\Http\Request;
use App\Models\BnContent;

class BnPostDetailController extends Controller
{

    public function detailPageContentHit($contentId){
        BnContent::where('content_id', $contentId)->increment('total_hit');
        return response()->json([
            'success' => 'Hit successfully!'
        ], 200);
    }

    public function detailPageGetCategory($catSlug){
        $getCategory = BnCategory::where('cat_slug', $catSlug)->first();
        return response()->json([
            'cat_id' => $getCategory->cat_id
        ], 200);

    }

    public function getInsideMoreNews($catId, $contentId){
        $insideMoreNews = BnContent::with('category:cat_id,cat_slug', 'subcategory:subcat_id,subcat_slug')
            ->select(['content_id', 'cat_id', 'subcat_id', 'content_heading', 'img_xs_path'])
            // ->whereRaw('FIND_IN_SET(?, tags)', $tags[0])
            ->where('content_id', '<>', $contentId)
            ->where('cat_id', $catId)
            ->where('status', 1)
            ->where('deletable', 1)
            ->orderByDesc('content_id')
            ->limit(5)
            ->get();
        return response()->json([
            'insideMoreNews' => $insideMoreNews
        ], 200);
    }

    public function getAuthor($author_slug){
        $aAuthorSlugs = explode(',', $author_slug);
        $sAuthorSlugs = "'" . implode("','",$aAuthorSlugs) . "'";

        $authors = BnAuthor::query()
            ->select(['author_name_bn', 'author_slug', 'img_path'])
            ->whereIn('author_slug', $aAuthorSlugs)
            ->where('deletable', 1)
            ->orderByRaw("FIELD(author_slug, $sAuthorSlugs)")
            ->get();
        return response()->json([
            'authors' => $authors
        ], 200);
    }

    public function getMoreContents($cat_id, $contentId){
        $moreContents = BnContent::with('category', 'subcategory')
            ->where('cat_id', $cat_id)
            ->where('content_id', '<>', $contentId)
            ->where('status', 1)
            ->where('deletable', 1)
            ->latest()
            ->take(5)
            ->get();
        return response()->json([
            'moreContents' => $moreContents
        ], 200);
    }

    public function getMoreDetailContents($contentId){
        $moreDetailContent = BnContent::with('category', 'subcategory', 'author')
            ->where('content_id', '<>', $contentId)
            ->where('status', 1)
            ->where('deletable', 1)
            ->orderBy('content_id', 'DESC')
            ->take(3)
            ->get();
        return response()->json([
            'moreDetailContent' => $moreDetailContent
        ], 200);
    }

    public function allLatestPosts(){

        $allLatestPost = BnContent::with('category', 'subcategory')
            ->where('status', 1)
            ->where('deletable', 1)
            ->orderBy('content_id', 'DESC')
            ->take(20)
            ->get();
        return response()->json([
            'allLatestPost' => $allLatestPost
        ], 200);

    }
    public function relatedContents($contentId){
        $relatedContents = BnContent::with('category', 'subcategory')
            ->where('content_id', '<>', $contentId)
            ->where('status', 1)
            ->where('deletable', 1)
            ->latest()
            ->take(8)
            ->get();
        return response()->json([
            'relatedContents' => $relatedContents
        ], 200);
    }
    public function details($catSlug, $contentId)
    {

        if (!is_numeric($contentId)) abort(404);

        $detailsContent = BnContent::with('category', 'subcategory', 'author')->where('content_id', $contentId)->where('status', 1)->where('deletable', 1)->first();
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

        $moreDetailContent = BnContent::with('category', 'subcategory', 'author')
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

//        return view('frontend.bn.details', compact('detailsContent', 'authors', 'insideMoreNews', 'relatedContents'/*, 'latestContents', 'popularContents'*/, 'moreContents','moreDetailContent', 'allLatestPost'));

        return response()->json([
            'detailsContent' =>$detailsContent,
            'authors' =>$authors,
            'insideMoreNews' =>$insideMoreNews,
            'relatedContents' =>$relatedContents,
            'moreContents' =>$moreContents,
            'moreDetailContent' =>$moreDetailContent,
            'allLatestPost' =>$allLatestPost,
        ], 200);

    }

}

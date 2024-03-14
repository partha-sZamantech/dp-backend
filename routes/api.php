<?php

use App\Http\Controllers\Frontend\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Frontend\HomeController;
use App\Http\Controllers\API\Frontend\AdsController;
use App\Http\Controllers\API\Frontend\FrontendVideoController;
use App\Http\Controllers\API\Frontend\BnPostDetailController;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


// =============== Post Detail Page APIS================== //
Route::get('/{catSlug}/{contentId}', [BnPostDetailController::class, 'details']);
//Route::get('/detail/hit/{contentId}', [BnPostDetailController::class, 'detailPageContentHit']);
//Route::get('/detail/getcat/{catSlug}', [BnPostDetailController::class, 'detailPageGetCategory']);
//Route::get('/detinsidemnews/{catId}/{contentId}', [BnPostDetailController::class, 'getInsideMoreNews']);
////Route::get('/detail/author/{author_slug}', [BnPostDetailController::class, 'getAuthor']);
//Route::get('/detgetmorecontent/{catId}/{contentId}', [BnPostDetailController::class, 'getMoreContents']);
//Route::get('/getdetail/contents/{contentId}', [BnPostDetailController::class, 'getMoreDetailContents']);
//Route::get('/detaillatest/posts/allpost', [BnPostDetailController::class, 'allLatestPosts']);
Route::get('/detailrelated/posts/{contentId}', [BnPostDetailController::class, 'relatedContents']);

// =============== Post Detail Page APIS================== //

Route::get('breaking-news', [HomeController::class, 'breakingNews']);
Route::get('specialvideotop', [HomeController::class, 'specialVideo']);
Route::get('headercat', [HomeController::class, 'headerCategory']);
Route::get('site-setting', [HomeController::class, 'siteSetting']);
Route::get('allcat', [HomeController::class, 'allCategory']);
Route::get('specialcontent', [HomeController::class, 'specialTopContents']);
Route::get('nationalcontent', [HomeController::class, 'homeNationalPositionContent']);
Route::get('politicscontent', [HomeController::class, 'homePoliticsContent']);
Route::get('economycontent', [HomeController::class, 'homeEconomyContent']);
Route::get('internationalcontent', [HomeController::class, 'homeInternationalContent']);
Route::get('tabpopularposts', [HomeController::class, 'homePopularPosts']);
Route::get('tablatestposts', [HomeController::class, 'homeLatestPosts']);
Route::get('specialreport', [HomeController::class, 'homeSpecialReport']);
Route::get('sportscontent', [HomeController::class, 'homeSportsPositionContent']);
Route::get('saradeshcontent', [HomeController::class, 'homeSaradeshPositionContent']);
Route::get('entertainmentcontent', [HomeController::class, 'homeEntertainmentPositionContent']);
Route::get('lawcourtcontent', [HomeController::class, 'homeLawCourtContent']);
Route::get('lifestylecontent', [HomeController::class, 'homeLifestyleContent']);
Route::get('crimecontent', [HomeController::class, 'homeCrimeContent']);
Route::get('technologycontent', [HomeController::class, 'homeTechnologyContent']);
Route::get('careercontent', [HomeController::class, 'homeCareerPositionContent']);
Route::get('campuscontent', [HomeController::class, 'homeCampusContent']);
Route::get('artscontent', [HomeController::class, 'homeArtsContent']);
Route::get('healthcontent', [HomeController::class, 'homeHealthContent']);
Route::get('religioncontent', [HomeController::class, 'homeReligionContent']);
Route::get('educationcontent', [HomeController::class, 'homeEducationContent']);
Route::get('childrencontent', [HomeController::class, 'homeChildrenContent']);
Route::get('motivationcontent', [HomeController::class, 'homeMotivationContent']);
Route::get('probashcontent', [HomeController::class, 'homeProbashContent']);
Route::get('corporatecontent', [HomeController::class, 'homeCorporateContent']);
Route::get('literaturecontent', [HomeController::class, 'homeLiteratureContent']);
Route::get('opinioncontent', [HomeController::class, 'homeOpinionContent']);
Route::get('specialarticlecontent', [HomeController::class, 'homeSpecialArticleContent']);
Route::get('homegallery', [HomeController::class, 'homeGallery']);


Route::get('/first/related/{contentId}', [HomeController::class, 'detailsPageFirstRelatedContent']);
Route::get('/dtpost/catws/{cat_id}/{contentId}', [HomeController::class, 'detailCategoryWisePost']);
Route::post('/relatedcontdetl', [HomeController::class, 'relatedContentBelow']);
Route::post('/insidemoreexceptpost', [HomeController::class, 'insideMoreDetailsPostExcept']);
Route::get('/catcontent/{catSlug}/{take}', [HomeController::class, 'categoryContent']);
Route::get('/tagcontents/{tagSlug}/{take}', [HomeController::class, 'tagContent']);

Route::get('/subcategorycontent/{catSlug}/{subcatSlug}/{take}', [HomeController::class, 'subcategoryContent']);
Route::post('/archive/post/get', [HomeController::class, 'archive']);
Route::post('/collection/latest', [HomeController::class, 'menuLatestPost']);
Route::post('/author/contents', [HomeController::class, 'authorContent']);

//Route::get('/share-image/{category}',  function (){
//    return 'ok';
//})->where(['category' => '[a-z-]+'])->name('modify.ogImage');
Route::get('/ogimage/get/{category}', [FileController::class, 'nuxtOgImage'])->where(['category' => '[a-z-]+'])->name('modify.ogImage');

// Ad Management API
Route::post('/common/get/ads', [AdsController::class, 'commonAds']);

Route::get('/video/{cat_slug}/{id}', [FrontendVideoController::class, 'bnVideoDetails']);

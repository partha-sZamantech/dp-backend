<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Backend\Bn\BnAdManagementController;
use App\Http\Controllers\Backend\Bn\BnContentController;
use App\Http\Controllers\Backend\Bn\BnContentPositionController;
use App\Http\Controllers\Backend\Bn\BnDashboardController;
use App\Http\Controllers\Backend\Bn\BnHelperController;
use App\Http\Controllers\Backend\Bn\BnMobileAdManagementController;
use App\Http\Controllers\Backend\Bn\BnVideoController;
use App\Http\Controllers\Backend\Bn\BnVideoPositionController;
use App\Http\Controllers\Backend\Bn\ElectionController;
use App\Http\Controllers\Backend\En\EnVideoPositionController;
use App\Http\Controllers\Backend\En\EnVideoController;
use App\Http\Controllers\Backend\En\EnBreakingNewsController;
use App\Http\Controllers\Backend\En\EnContentController;
use App\Http\Controllers\Backend\En\EnContentPositionController;
use App\Http\Controllers\Backend\Epaper\EpaperController;
use App\Http\Controllers\Backend\Epaper\EpaperPageController;
use App\Http\Controllers\Backend\Magazine\MagazineController;
use App\Http\Controllers\Backend\Magazine\MagazinePageController;
use App\Http\Controllers\Backend\Photo\PhotoAlbumController;
use App\Http\Controllers\Backend\Photo\PhotoCategoryController;
use App\Http\Controllers\Backend\Settings\Bn\BnAuthorController;
use App\Http\Controllers\Backend\Bn\BnBreakingNewsController;
use App\Http\Controllers\Backend\Settings\Bn\BnCategoryController;
use App\Http\Controllers\Backend\Settings\Bn\BnSiteSettingsController;
use App\Http\Controllers\Backend\Settings\Bn\BnSubcategoryController;
use App\Http\Controllers\Backend\Settings\Bn\BnTagController;
use App\Http\Controllers\Backend\Settings\Bn\BnVideoCategoryController;
use App\Http\Controllers\Backend\Settings\CountryController;
use App\Http\Controllers\Backend\Settings\DistrictController;
use App\Http\Controllers\Backend\Settings\DivisionController;
use App\Http\Controllers\Backend\Settings\En\EnAuthorController;
use App\Http\Controllers\Backend\Settings\En\EnCategoryController;
use App\Http\Controllers\Backend\Settings\En\EnSiteSettingsController;
use App\Http\Controllers\Backend\Settings\En\EnSubcategoryController;
use App\Http\Controllers\Backend\Settings\En\EnTagController;
use App\Http\Controllers\Backend\Settings\En\EnVideoCategoryController;
use App\Http\Controllers\Backend\Settings\UpozillaController;
use App\Http\Controllers\Backend\Settings\User\MisUserController;
use App\Http\Controllers\Backend\Settings\User\UserController;
use App\Http\Controllers\Frontend\BnFrontendController;
use App\Http\Controllers\Frontend\BnVideoFrontendController;
use App\Http\Controllers\Frontend\DataController;
use App\Http\Controllers\Frontend\EnFrontendController;
use App\Http\Controllers\Frontend\EnVideoFrontendController;
use App\Http\Controllers\Frontend\FileController;
use App\Http\Controllers\Frontend\PhotoFrontendController;
use App\Http\Controllers\ManualDocController;
use App\Http\Controllers\ManualPhotoController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Photo\PhotoAlbumPositionController;
use App\Http\Controllers\Backend\Bn\BnPollController;
use App\Http\Controllers\Frontend\BnPollFrontendController;
use App\Http\Controllers\Backend\Bn\BnPendingContentController;
use App\Http\Controllers\Backend\En\EnPendingContentController;
use App\Http\Controllers\Backend\Bn\CounterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/clear-dp', function () {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    return 'true';
});


/*Route::get('/info', function () {
    echo phpinfo();
});*/

//Auth::routes();

Route::get('login', function (){
    return redirect('/', 301);
});

Route::get('dplogin', [AuthenticatedController::class, 'create'])->name('admin.login')->middleware('guest');
Route::post('dplogin', [AuthenticatedController::class, 'store'])->name('admin.login.submit');
Route::post('admin/logout', [AuthenticatedController::class, 'destroy'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/backend/dashboard', [BnDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/backend/pending/en-contents', [BnDashboardController::class, 'pendingEnglish'])->name('admin.pending.en');
    Route::get('/backend/pending/bn-contents', [BnDashboardController::class, 'pendingBangla'])->name('admin.pending.bn');

    // News Admin Routes - 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin
    Route::middleware('check.role:1,2')->group(function(){

        //===================== Approve Content =====================
        Route::post('/backend/pending/bn-content/{content_id}', [BnPendingContentController::class, 'bnApprove'])->name('bn.content.approve');
        Route::post('/backend/pending/en-content/{content_id}', [EnPendingContentController::class, 'enApprove'])->name('en.content.approve');
        //===================== Approve Content =====================

    });

    // News Admin Routes - 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin
    Route::middleware('check.role:1,2,4,5')->group(function(){

        Route::get('backend/counter', [CounterController::class, 'index'])->name('admin.counter');

        Route::get('backend/quickupdate-content', [BnContentController::class, 'getQuickUpdateContent'])->name('bn-contents.getQuickUpdateContent');
        Route::post('backend/quickupdate-content', [BnContentController::class, 'postQuickUpdate'])->name('bn-contents.postQuickUpdate');
        Route::get('backend/enable-bn-content/{id}', [BnContentController::class, 'enableContent']);
        Route::get('backend/deleted-bn-contents', [BnContentController::class, 'deletedList']);
        Route::get('backend/populate-category', [BnContentController::class, 'populateCat']);
        Route::resource('backend/bn-contents', BnContentController::class);

        Route::get('backend/bn-breaking-news/setting-position', [BnBreakingNewsController::class, 'settingPosition'])->name('bn-breaking-news.getSettingPosition');
        Route::post('backend/bn-breaking-news/save-setting-position', [BnBreakingNewsController::class, 'saveSettingPosition'])->name('bn-breaking-news.saveSettingPosition');
        Route::resource('backend/bn-breaking-news', BnBreakingNewsController::class);
        Route::resource('backend/bn-videos', BnVideoController::class);

        Route::get('backend/bn-populate-video-position', [BnVideoPositionController::class, 'populatePosition']);
        Route::get('backend/bn-video-position/change/{id}', [BnVideoPositionController::class, 'getChangePosition'])->name('bn-video-position.change');
        Route::post('backend/bn-video-position/change', [BnVideoPositionController::class, 'changePosition']); // news position sortable save route
        Route::get('backend/bn-video-position/keyword', [BnVideoPositionController::class, 'autocompleteBnVideoSearch']);
        Route::resource('backend/bn-video-position', BnVideoPositionController::class)->except('show');
        Route::resource('backend/elections', ElectionController::class)->except('show');

        Route::get('backend/bn-populate-position', [BnContentPositionController::class, 'populatePosition']);
        Route::get('backend/bn-content-position/keyword', [BnContentPositionController::class, 'autocompleteBnContentSearch']);
        Route::get('backend/bn-content-position/change/{id}', [BnContentPositionController::class, 'getChangePosition'])->name('bn-content-position.change');
        // Route::post('backend/bn-content-position/change', 'BnContentPositionController, 'postBnSetPosition');
        Route::post('backend/bn-position/change', [BnContentPositionController::class, 'changePosition']); // news position sortable save route
        Route::resource('backend/bn-content-position', BnContentPositionController::class)->except('show');
        Route::get('/backend/bn-fix-content-position', [BnContentPositionController::class, 'fixContentPosition'])->name('fix_contentPosition');
        Route::post('/backend/bn-fix-content-position-update', [BnContentPositionController::class, 'updateContentPositionFixed'])->name('bnupdateContentPositionFixed');

        Route::get('backend/upozilla-populate', [UpozillaController::class, 'upozillaPopulate']);
//    Route::resource('/backend/monthly-folders', MonthlyFolderController::class)->except('show');

        Route::get('backend/subcat-populate', [BnSubcategoryController::class, 'subcatPopulate']);

        Route::get('backend/normaltag-search', [SearchController::class, 'searchNormalTag']);
        Route::get('backend/author-search', [SearchController::class, 'searchAuthor']);

        // Magazine Routes
        Route::resource('backend/magazines', MagazineController::class)->except('show');
        Route::resource('backend/magazines/{magazine}/magazine-pages', MagazinePageController::class)->except('show');

        // E-Paper Routes
        Route::resource('backend/epapers', EpaperController::class)->except('show');
        Route::resource('backend/epapers/{epaper}/epaper-pages', EpaperPageController::class)->except('show');
    });

    // Admin Routes 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin
    Route::middleware('check.role:1,2,4,5,6')->group(function() {
        Route::resource('backend/manual-photos', ManualPhotoController::class)->except('show');
        Route::resource('backend/manual-docs', ManualDocController::class)->except('show');
        Route::post('backend/attach-photo-upload', [ManualPhotoController::class, 'attachPhotoUpload']);
    });

    // Adv Admin Routes 3=Adv Admin
//    Route::middleware('check.role:1')->group(function(){
        Route::resource('backend/photo-albums', PhotoAlbumController::class)->except('show');
        Route::resource('backend/photo-album-positions', PhotoAlbumPositionController::class)->except('show');
        Route::get('backend/photo-album-position/change/{id}', [PhotoAlbumPositionController::class, 'getChangePosition'])->name('photo-album-positions.getChangePosition');
        Route::get('backend/photo-album-position/keyword', [PhotoAlbumPositionController::class, 'autocompletePhotoAlbumSearch']);
        Route::post('backend/photo-album-position/change', [PhotoAlbumPositionController::class, 'changePosition']);
        Route::get('backend/photo-album-populate-position', [PhotoAlbumPositionController::class, 'populatePosition']);
//    });

    // Adv Admin Routes 3=Adv Admin
    Route::middleware('check.role:1,3')->group(function(){
        Route::resource('backend/bn-ads', BnAdManagementController::class)->except('show', 'destroy');
        Route::resource('backend/bn-mobile-ads', BnMobileAdManagementController::class)->except('show', 'destroy');
    });

    // BN Admin Routes 1=Super Admin, 2=News Admin
    Route::middleware('check.role:1,2,5')->group(function() {
        Route::resource('backend/bn-tags', BnTagController::class)->except('show');
        Route::resource('backend/bn-authors', BnAuthorController::class)->except('show');
        Route::resource('backend/bn-polls', BnPollController::class)->except('show');
    });

    // BN Admin Routes 1=Super Admin
    Route::middleware('check.role:1')->group(function(){
        // BN Routes
        Route::resource('backend/countries', CountryController::class)->except('show');
        Route::resource('backend/divisions', DivisionController::class)->except('show');
        Route::resource('backend/districts', DistrictController::class)->except('show');
        Route::resource('backend/upozillas', UpozillaController::class)->except('show');
        Route::resource('backend/bn-categories', BnCategoryController::class)->except('show');
        Route::resource('backend/bn-subcategories', BnSubcategoryController::class)->except('show');
        Route::resource('backend/bn-site-settings', BnSiteSettingsController::class)->only(['index', 'store']);
        Route::resource('backend/bn-video-categories', BnVideoCategoryController::class)->except('show');
        Route::resource('backend/mis-users', MisUserController::class)->except('show');
        Route::resource('backend/users', UserController::class)->except('show');
        Route::get('backend/user/{id}/change-password', [UserController::class, 'getChangePassword'])->name('users.getChangePassword');
        Route::put('backend/user/{id}/change-password', [UserController::class, 'postChangePassword'])->name('users.postChangePassword');
    });

    // EN News Admin Routes - 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin
    Route::middleware('check.role:1,2,6')->group(function(){
        // En Routes
        Route::get('backend/en-subcat-populate', [EnSubcategoryController::class, 'subcatPopulate']);
        Route::get('backend/en-normaltag-search', [SearchController::class, 'searchEnNormalTag']);
        Route::get('backend/en-populate-category', [EnContentController::class, 'populateCat']);
        Route::get('backend/en-quickupdate-content', [EnContentController::class, 'getQuickUpdateContent']);
        Route::post('backend/en-quickupdate-content', [EnContentController::class, 'postQuickUpdate'])->name('en-contents.postQuickUpdate');
        Route::resource('backend/en-contents', EnContentController::class)->except('show');

        Route::get('backend/en-populate-position', [EnContentPositionController::class, 'populatePosition']);
        Route::get('backend/en-content-position/keyword', [EnContentPositionController::class, 'autocompleteEnContentSearch']);
        Route::get('backend/en-content-position/change/{id}', [EnContentPositionController::class, 'getChangePosition'])->name('en-content-position.getChangePosition');
        Route::post('backend/en-position/change', [EnContentPositionController::class, 'changePosition']); // news position sortable save route
        Route::resource('backend/en-content-position', EnContentPositionController::class)->except('show');

        Route::get('backend/en-breaking-news/setting-position', [EnBreakingNewsController::class, 'settingPosition'])->name('en-breaking-news.getSettingPosition');
        Route::post('backend/en-breaking-news/save-setting-position', [EnBreakingNewsController::class, 'saveSettingPosition'])->name('en-breaking-news.saveSettingPosition');
        Route::resource('backend/en-breaking-news', EnBreakingNewsController::class);
        Route::resource('backend/en-videos', EnVideoController::class);

        Route::get('backend/en-populate-video-position', [EnVideoPositionController::class, 'populatePosition']);
        Route::get('backend/en-video-position/change/{id}', [EnVideoPositionController::class, 'getChangePosition'])->name('en-video-position.change');
        Route::post('backend/en-video-position/change', [EnVideoPositionController::class, 'changePosition']); // news position sortable save route
        Route::get('backend/en-video-position/keyword', [EnVideoPositionController::class, 'autocompleteEnVideoSearch']);
        Route::resource('backend/en-video-position', EnVideoPositionController::class)->except('show');
    });

    // EN Admin Routes 1=Super Admin, 2=News Admin
    Route::middleware('check.role:1,2,5')->group(function() {
        Route::resource('/backend/en-authors', EnAuthorController::class)->except('show');
        Route::resource('/backend/en-tags', EnTagController::class)->except('show');
    });

    // EN Admin Routes 1=Super Admin
    Route::middleware('check.role:1')->group(function() {
        // En Routes
        Route::resource('/backend/en-site-settings', EnSiteSettingsController::class)->only(['index', 'store']);
        Route::resource('backend/en-video-categories', EnVideoCategoryController::class)->except('show');
        Route::resource('/backend/en-categories', EnCategoryController::class)->except('show');
        Route::resource('/backend/en-subcategories', EnSubcategoryController::class)->except('show');
    });

    // Photo Routes 1=Super Admin
    Route::middleware('check.role:1')->group(function() {
        Route::resource('/backend/photo-categories', PhotoCategoryController::class)->except('show');
    });
});

// En Frontend routes
Route::prefix('english')->group(function () {
    // Video frontend routes
    Route::prefix('/video')->group(function () {
        Route::get('/', [EnVideoFrontendController::class, 'index']);
        Route::get('/{cat_slug}/{id}', [EnVideoFrontendController::class, 'enVideoDetails']);
    });

    Route::get('/', [EnFrontendController::class, 'index']);
    Route::get('/search', function () {return view('frontend.en.search');});
    Route::get('/video/show/{id}', [EnVideoFrontendController::class, 'enVideoDetails']);
    Route::get('/archive/{date?}', [EnFrontendController::class, 'archive']);
    Route::get('/news-sitemap.xml', [EnFrontendController::class, 'generateSitemap']);
    Route::get('/author/{authorSlug}', [EnFrontendController::class, 'authorContent']);
    Route::get('/{catSlug}', [EnFrontendController::class, 'categoryContent']);
    Route::get('/{catSlug}/{subcatSlug}', [EnFrontendController::class, 'subcategoryContent']);
    Route::get('/{catSlug}/{contentType}/{contentId}', [EnFrontendController::class, 'details']);
    Route::get('/bangladesh/{division}/{district?}/{upozilla?}', [EnFrontendController::class, 'divisionDistrictUpozillaContent']);

});

// Photo Gallery routes
Route::prefix('photo')->group(function () {
    Route::get('/', [PhotoFrontendController::class, 'index']);
    Route::get('/{cat_slug}', [PhotoFrontendController::class, 'category'])->where('category', '[a-z-]+');
    Route::get('/{cat_slug}/{subcategory}', [PhotoFrontendController::class, 'subcategory'])->where('category', '[a-z-]+')->where('subcategory', '[a-z-]+');
    Route::get('/{cat_slug}/{subcategory}/{id}', [PhotoFrontendController::class, 'details'])->where('category', '[a-z-]+')->where('subcategory', '[a-z-]+')->where('id', '[0-9]+');
});


// Video frontend routes
Route::prefix('video')->group(function () {
    Route::get('/', [BnVideoFrontendController::class, 'index'])->name('video');
    Route::get('/{cat_slug}', [BnVideoFrontendController::class, 'category'])->name('video.category');
    Route::get('/{cat_slug}/{id}', [BnVideoFrontendController::class, 'bnVideoDetails']);
});

//Poll Frontend Routes
Route::prefix('poll')->group(function () {
    Route::get('/', [BnPollFrontendController::class, 'index'])->name('poll.index');
    Route::post('/submit_vote', [BnPollFrontendController::class, 'submit_vote'])->name('poll.submit_vote');
    Route::post('/change_vote', [BnPollFrontendController::class, 'change_vote'])->name('poll.change_vote');
});

// Bn Frontend routes
Route::get('rss/{slug}.xml', [DataController::class, 'rss'])->where(['slug' => '[a-z-]+']);
Route::get('epaper/{date}', [BnFrontendController::class, 'getEpaper'])->name('epaper');
Route::get('magazine/grand-opening', [BnFrontendController::class, 'getMagazines'])->name('magazine');

Route::get('/district-populate', [BnHelperController::class, 'districtPopulate']);
Route::get('/upozilla-populate', [BnHelperController::class, 'upozillaPopulate']);
Route::get('/archive/{date?}', [BnFrontendController::class, 'archive']);
Route::get('/news-sitemap.xml', [BnFrontendController::class, 'generateSitemap']);
Route::get('/privacy-policy', function () {
    return view('frontend.common.privacy');
});

Route::get('/terms-of-use', function () {
    return view('frontend.common.terms');
});
Route::get('/about-us', function () {
    return view('frontend.common.about_us');
})->name('about_us');
Route::get('/contact', [BnFrontendController::class, 'contact'])->name('contact');

Route::get('/converter', function () {
    return view('frontend.common.converter');
})->name('converter');
Route::get('/share-image/{category}', [FileController::class, 'getOG'])->where(['category' => '[a-z-]+'])->name('modify.ogImage');

Route::get('/', [BnFrontendController::class, 'index']);
Route::get('/search', function () {return view('frontend.bn.search');});
Route::get('/topic/{tagSlug}', [BnFrontendController::class, 'tagContent']);
Route::get('/author/{authorSlug}', [BnFrontendController::class, 'authorContent']);
Route::get('/{catSlug}', [BnFrontendController::class, 'categoryContent']);
Route::get('/latest/posts', [BnFrontendController::class, 'latestPostContents']);
Route::get('/{catSlug}/{subcatSlug}', [BnFrontendController::class, 'subcategoryContent']);

Route::get('/{catSlug}/{contentType}/{contentId}', [BnFrontendController::class, 'details'])->where('contentId', '[0-9]+');
Route::get('/bangladesh/{division}/{district?}/{upozilla?}', [BnFrontendController::class, 'divisionDistrictUpozillaContent']);


//Route::get('post/delete/all', function (){
//    $number = 1;
//    for ($i=0; $i<53000; $i++){
//        $contentId = $i;
//        $ok = \App\Models\BnContent::where('content_id', $contentId)->first();
//        if ($ok){
//            $ok->delete();
//        }
//
//    }
//});

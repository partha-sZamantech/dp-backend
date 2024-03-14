<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\Photo\PhotoHelperController;
use App\Http\Controllers\Controller;
use App\Models\PhotoAlbum;
use App\Models\PhotoCategory;
use Illuminate\Support\Facades\Cache;

class PhotoFrontendController extends Controller
{
    public $homePhotoGalleryCacheKey = 'homePhotoGalleryCacheKey';
    public $bangladeshAlbumsCacheKey = 'bangladeshAlbumsCacheKey';
    public $entertainmentAlbumsCacheKey = 'entertainmentAlbumsCacheKey';
    public $sportsAlbumsCacheKey = 'sportsAlbumsCacheKey';
    public $lifestyleAlbumsCacheKey = 'lifestyleAlbumsCacheKey';
    public $internationalAlbumsCacheKey = 'internationalAlbumsCacheKey';
    public $technologyAlbumsCacheKey = 'technologyAlbumsCacheKey';
    public $travelAlbumsCacheKey = 'travelAlbumsCacheKey';
    public $otherAlbumsCacheKey = 'otherAlbumsCacheKey';

    public function index()
    {
        // Photo Gallery
        $photoAlbums = PhotoHelperController::getPositionContent(1, null, $this->homePhotoGalleryCacheKey);

        // Bangladesh Album
        if (!Cache::has($this->bangladeshAlbumsCacheKey)) {
            $bangladeshAlbums = PhotoHelperController::getCategoryAlbum(1, 9);
            Cache::forever($this->bangladeshAlbumsCacheKey, $bangladeshAlbums);
        } else {
            $bangladeshAlbums = Cache::get($this->bangladeshAlbumsCacheKey);
        }

        // Entertainment Album
        if (!Cache::has($this->entertainmentAlbumsCacheKey)) {
            $entertainmentAlbums = PhotoHelperController::getCategoryAlbum(3, 6);
            Cache::forever($this->entertainmentAlbumsCacheKey, $entertainmentAlbums);
        } else {
            $entertainmentAlbums = Cache::get($this->entertainmentAlbumsCacheKey);
        }

        // Sports Album
        if (!Cache::has($this->sportsAlbumsCacheKey)) {
            $sportsAlbums = PhotoHelperController::getCategoryAlbum(2, 8);
            Cache::forever($this->sportsAlbumsCacheKey, $sportsAlbums);
        } else {
            $sportsAlbums = Cache::get($this->sportsAlbumsCacheKey);
        }

        // Lifestyle Album
        if (!Cache::has($this->lifestyleAlbumsCacheKey)) {
            $lifestyleAlbums = PhotoHelperController::getCategoryAlbum(7, 9);
            Cache::forever($this->lifestyleAlbumsCacheKey, $lifestyleAlbums);
        } else {
            $lifestyleAlbums = Cache::get($this->lifestyleAlbumsCacheKey);
        }

        // International Album
        if (!Cache::has($this->internationalAlbumsCacheKey)) {
            $internationalAlbums = PhotoHelperController::getCategoryAlbum(4, 6);
            Cache::forever($this->internationalAlbumsCacheKey, $internationalAlbums);
        } else {
            $internationalAlbums = Cache::get($this->internationalAlbumsCacheKey);
        }

        // Technology Album
        if (!Cache::has($this->technologyAlbumsCacheKey)) {
            $technologyAlbums = PhotoHelperController::getCategoryAlbum(5, 9);
            Cache::forever($this->technologyAlbumsCacheKey, $technologyAlbums);
        } else {
            $technologyAlbums = Cache::get($this->technologyAlbumsCacheKey);
        }

        // Travelling Album
        if (!Cache::has($this->travelAlbumsCacheKey)) {
            $travelAlbums = PhotoHelperController::getCategoryAlbum(6, 6);
            Cache::forever($this->travelAlbumsCacheKey, $travelAlbums);
        } else {
            $travelAlbums = Cache::get($this->travelAlbumsCacheKey);
        }

        // Other Album
        if (!Cache::has($this->otherAlbumsCacheKey)) {
            $otherAlbums = PhotoHelperController::getCategoryAlbum(8, 8);
            Cache::forever($this->otherAlbumsCacheKey, $otherAlbums);
        } else {
            $otherAlbums = Cache::get($this->otherAlbumsCacheKey);
        }

        return view('frontend.photo.home', compact('photoAlbums', 'bangladeshAlbums', 'entertainmentAlbums', 'sportsAlbums', 'lifestyleAlbums', 'internationalAlbums', 'technologyAlbums', 'travelAlbums', 'otherAlbums'));
    }

    public function category($cat_slug)
    {
        $category = PhotoCategory::where('cat_slug', $cat_slug)->where('status', 1)->where('deletable', 1)->first();

        if(is_null($category)){
            abort(404);
        }

        $categoryAlbums = PhotoHelperController::getCategoryAlbum($category->cat_id, 12, true);

        return view('frontend.photo.category', compact('categoryAlbums', 'category'));
    }

    //    public function subcategory()
//    {
//        return view('frontend.photo.subcategory');
//    }

    public function details($cat_slug, $sub_cat_slug, $album_id)
    {
        if (!is_numeric($album_id)) abort(404);

        $detailAlbum = PhotoAlbum::with(['category'])->where('album_id', $album_id)->where('deletable', 1)->first();
        if (!$detailAlbum) abort(404);

        $moreAlbums = PhotoAlbum::with('category')
                                 ->where('cat_id', $detailAlbum->cat_id)
                                 ->where('album_id', '<>', $album_id)
                                 ->where('deletable', 1)
                                 ->latest()
                                 ->take(8)
                                 ->get();

        return view('frontend.photo.details', compact('detailAlbum', 'moreAlbums'));
    }

    public function clearPhotoHomePageContentCache(){
        Cache::forget($this->homePhotoGalleryCacheKey);
        Cache::forget($this->bangladeshAlbumsCacheKey);
        Cache::forget($this->entertainmentAlbumsCacheKey);
        Cache::forget($this->sportsAlbumsCacheKey);
        Cache::forget($this->lifestyleAlbumsCacheKey);
        Cache::forget($this->internationalAlbumsCacheKey);
        Cache::forget($this->technologyAlbumsCacheKey);
        Cache::forget($this->travelAlbumsCacheKey);
        Cache::forget($this->otherAlbumsCacheKey);

        return true;
    }
}


<?php

namespace App\Http\Controllers\Backend\Photo;

use App\Http\Controllers\Controller;
use App\Models\BnBreakingNews;
use App\Models\BnContent;
use App\Models\BnContentPosition;
use App\Models\BnSubcategory;
use App\Models\District;
use App\Models\PhotoAlbum;
use App\Models\PhotoAlbumPosition;
use App\Models\Upozilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PhotoHelperController extends Controller
{
    public static function getPositionContent($positionId=null, $catId=null, $cacheKey=null)
    {
        $contents = collect();
        if (!Cache::has($cacheKey)) {
            $position = PhotoAlbumPosition::query()
                ->select(['position_id', 'position_name', 'cat_id', 'special_cat_id', 'subcat_id', 'content_ids', 'total_content'])
                ->when($positionId, function($query) use ($positionId){
                     return $query->where('position_id', $positionId);
                 })
                ->when($catId, function ($query) use ($catId){
                     return $query->where('cat_id', $catId);
                 })
                ->where('status', 1)
                ->where('deletable', 1)
                ->first();
            if ($position && $position->content_ids) {
                $aContentIDs = explode(",", $position->content_ids);
                $aContentIDs = array_slice($aContentIDs, 0, $position->total_content);
                $sContentIDs = implode(',', $aContentIDs);
                $contents = PhotoAlbum::with('category')->whereIn('album_id', $aContentIDs)->where('deletable', 1)->orderByRaw("FIELD(album_id, $sContentIDs)")->get();
                Cache::forever($cacheKey, $contents);
            }
        } else {
            $contents = Cache::get($cacheKey);
        }

        return $contents;
    }

    public static function getCategoryAlbum($catId, $limit, $paginate = false)
    {
        $albums = PhotoAlbum::with(['category'])->where('cat_id', $catId)->where('deletable', 1)->where('status', 1)->orderBy('album_id', 'desc');

        if ($paginate) {
            $albums = $albums->paginate($limit);
        } else {
            $albums = $albums->take($limit)->get();
        }

        return $albums;
    }

    public static function getLatestAlbum($limit = 5, $paginate = false)
    {
        $albums = PhotoAlbum::with(['category'])->where('deletable', 1)->where('status', 1)->orderBy('album_id', 'desc');

        if ($paginate) {
            $albums = $albums->paginate($limit);
        } else {
            $albums = $albums->take($limit)->get();
        }
        return $albums;
    }

    public static function getLatestCatContent($catId, $limit = 5, $skip = null)
    {
        $albums = PhotoAlbum::with(['category'])->where('cat_id', $catId)->where('deletable', 1)->where('status', 1)->orderBy('album_id', 'desc');

        if ($skip) {
            $albums = $albums->skip($skip);
        }

        return $albums->take($limit)->get();
    }
}

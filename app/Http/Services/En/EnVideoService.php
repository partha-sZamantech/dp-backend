<?php


namespace App\Http\Services\En;

use App\Models\EnVideo;
use App\Models\EnVideoPosition;
use Illuminate\Support\Facades\Cache;

class EnVideoService
{
    public $enVideoCacheKey = 'enVideoCacheKey-';
    public $enVideosCacheKey = 'enVideosCacheKey';
    public $enSpecialTopVideoCacheKey = 'enSpecialTopVideoCacheKey';
    public $enSpecialEventVideoCacheKey = 'enSpecialEventVideoCacheKey';

    public function getEnSpecialTopVideos()
    {
        if (!Cache::has($this->enSpecialTopVideoCacheKey)) {
            $videos = [];
            $specialTopPosition = EnVideoPosition::where('position_id', 1)->where('deletable', 1)->first();

            if ($specialTopPosition && $specialTopPosition->video_ids) {
                $aVideoIDs = explode(",", $specialTopPosition->video_ids);
                $aVideoIDs = array_slice($aVideoIDs, 0, $specialTopPosition->total_video);
                $sVideoIDs = implode(',', $aVideoIDs);

                $videos = EnVideo::query()
                    ->with('category:id,slug,name')
                    ->select(['id', 'cat_id', 'type', 'title', 'img_sm_path', 'code'])
                    ->whereIn('id', $aVideoIDs)
                    ->where('status', 1)->where('deletable', 1)
                    ->orderByRaw("FIELD(id, $sVideoIDs)")
                    ->get();

                if ($videos->count()) {
                    Cache::forever($this->enSpecialTopVideoCacheKey, $videos);
                }
            }

        } else {
            $videos = Cache::get($this->enSpecialTopVideoCacheKey);
        }

        return $videos;
    }

    public function getEnSpecialEventVideos()
    {
        if (!Cache::has($this->enSpecialEventVideoCacheKey)) {
            $videos = EnVideo::query()
                ->select(['id', 'type', 'title', 'img_sm_path', 'link', 'code', 'created_at'])
                ->where('cat_id', 2)
                ->orderBy('id')
                ->get();

            if ($videos->count()) {
                Cache::forever($this->enSpecialEventVideoCacheKey, $videos);
            }

        } else {
            $videos = Cache::get($this->enSpecialEventVideoCacheKey);
        }

        return $videos;
    }

    public function getVideo($id)
    {
        if (!Cache::has($this->enVideoCacheKey.$id)) {
            $video = EnVideo::query()
                ->with('category:id,name,slug')
                ->select(['id', 'cat_id', 'type', 'title', 'img_bg_path', 'link', 'code', 'meta_keywords', 'meta_description', 'created_at'])
                ->where('id', $id)
                ->orderBy('id')
                ->first();

            if (!empty($video)) {
                Cache::forever($this->enVideoCacheKey.$id, $video);
            }

        } else {
            $video = Cache::get($this->enVideoCacheKey.$id);
        }

        return $video;
    }

    public function getVideos($limit)
    {
        if (!Cache::has($this->enVideosCacheKey)) {
            $videos = EnVideo::query()
                ->with('category:id,name,slug')
                ->select(['id', 'cat_id', 'type', 'title', 'img_sm_path', 'link', 'code', 'created_at'])
                ->orderBy('id')
                ->take($limit)
                ->get();

            if ($videos->count()) {
                Cache::forever($this->enVideosCacheKey, $videos);
            }

        } else {
            $videos = Cache::get($this->enVideosCacheKey);
        }

        return $videos;
    }

    public function clearCache($id=null)
    {
        Cache::forget($this->enVideosCacheKey);
        Cache::forget($this->enSpecialTopVideoCacheKey);
        Cache::forget($this->enSpecialEventVideoCacheKey);
        if (is_numeric($id)) {
            Cache::forget($this->enVideoCacheKey.$id);
        }
    }

}

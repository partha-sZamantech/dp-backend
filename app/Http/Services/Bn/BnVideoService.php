<?php


namespace App\Http\Services\Bn;

use App\Models\BnVideo;
use App\Models\BnVideoPosition;
use Illuminate\Support\Facades\Cache;

class BnVideoService
{
    public $bnVideoCacheKey = 'bnVideoCacheKey-';
    public $bnVideosCacheKey = 'bnVideosCacheKey';
    public $bnSpecialTopVideoCacheKey = 'bnSpecialTopVideoCacheKey';
    public $bnSpecialEventVideoCacheKey = 'bnSpecialEventVideoCacheKey';

    public function getBnSpecialTopVideos()
    {
        if (!Cache::has($this->bnSpecialTopVideoCacheKey)) {
            $videos = (object)[];
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
                    ->get();

                if ($videos->count()) {
                    Cache::forever($this->bnSpecialTopVideoCacheKey, $videos);
                }
            }

        } else {
            $videos = Cache::get($this->bnSpecialTopVideoCacheKey);
        }

        return $videos;
    }

    public function getBnSpecialEventVideos()
    {
        if (!Cache::has($this->bnSpecialEventVideoCacheKey)) {
            $videos = [];
            $specialTopPosition = BnVideoPosition::where('position_id', 2)->where('deletable', 1)->first();

            if ($specialTopPosition && $specialTopPosition->video_ids) {
                $aVideoIDs = explode(",", $specialTopPosition->video_ids);
                $aVideoIDs = array_slice($aVideoIDs, 0, $specialTopPosition->total_video);
                $sVideoIDs = implode(',', $aVideoIDs);

                $videos = BnVideo::query()
                    ->with('category:id,slug,name_bn')
                    ->select(['id', 'cat_id', 'type', 'title', 'img_bg_path', 'code', 'is_live', 'target'])
                    ->whereIn('id', $aVideoIDs)
                    ->where('status', 1)->where('deletable', 1)
                    ->orderByRaw("FIELD(id, $sVideoIDs)")
                    ->get();

                if ($videos->count()) {
                    Cache::forever($this->bnSpecialEventVideoCacheKey, $videos);
                }
            }

        } else {
            $videos = Cache::get($this->bnSpecialEventVideoCacheKey);
        }

        return $videos;
    }

    public function getVideo($id)
    {
        if (!Cache::has($this->bnVideoCacheKey.$id)) {
            $video = BnVideo::query()
                ->with('category:id,name_bn,slug')
                ->select(['id', 'cat_id', 'type', 'title', 'img_bg_path', 'link', 'code', 'created_at'])
                ->where('id', $id)
                ->orderBy('id')
                ->first();

            if (!empty($video)) {
                Cache::forever($this->bnVideoCacheKey.$id, $video);
            }

        } else {
            $video = Cache::get($this->bnVideoCacheKey.$id);
        }

        return $video;
    }

    public function getVideos($limit)
    {
//        if (!Cache::has($this->bnVideosCacheKey)) {
            $videos = BnVideo::query()
                ->with('category:id,name_bn,slug')
                ->select(['id', 'cat_id', 'type', 'title', 'img_sm_path', 'link', 'code', 'target', 'created_at'])
                ->orderBy('id', 'desc')
                ->take($limit)
                ->get();

        /*    if ($videos->count()) {
                Cache::forever($this->bnVideosCacheKey, $videos);
            }

        } else {
            $videos = Cache::get($this->bnVideosCacheKey);
        }*/

        return $videos;
    }

    public function clearCache($id=null)
    {
        Cache::forget($this->bnVideosCacheKey);
        Cache::forget($this->bnSpecialTopVideoCacheKey);
        Cache::forget($this->bnSpecialEventVideoCacheKey);
        if (is_numeric($id)) {
            Cache::forget($this->bnVideoCacheKey.$id);
        }
    }

}

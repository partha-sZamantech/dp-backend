<?php


namespace App\Http\Services;

use App\Models\BnVideo;
use Illuminate\Support\Facades\Cache;

class BnVideoService
{
    public $bnSpecialTopVideoCacheKey = 'bnSpecialTopVideoCacheKey';

    public function getBnVideos()
    {
        if (!Cache::has($this->bnSpecialTopVideoCacheKey)) {
            $videos = BnVideo::query()
                ->select(['id', 'type', 'title', 'link', 'code'])
                ->get();

            if ($videos->count()) {
                Cache::forever($this->bnSpecialTopVideoCacheKey, $videos);
            }

        } else {
            $videos = Cache::get($this->bnSpecialTopVideoCacheKey);
        }

        return $videos;
    }

    public function clearCache()
    {
        Cache::forget($this->bnSpecialTopVideoCacheKey);
    }

}
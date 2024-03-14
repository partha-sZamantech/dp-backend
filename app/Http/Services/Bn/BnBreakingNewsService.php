<?php


namespace App\Http\Services\Bn;

use App\Models\BnBreakingNews;
use Illuminate\Support\Facades\Cache;

class BnBreakingNewsService
{
    public $bnBreakingNewsCacheKey = 'bnBreakingNewsCacheKey';

    public function getBreakingNews()
    {
        if (!Cache::has($this->bnBreakingNewsCacheKey)) {
            $breakingNews = BnBreakingNews::query()
                ->select(['id', 'news_title', 'news_link', 'expired_time'])
                ->where('expired_time', '>', now())
                ->orderBy('position')
                ->get();

            if ($breakingNews->count()) {
                Cache::forever($this->bnBreakingNewsCacheKey, $breakingNews);
            }

        } else {
            $breakingNews = Cache::get($this->bnBreakingNewsCacheKey);
        }

        return $breakingNews->where('expired_time', '>', now());
    }

    public function clearCache()
    {
        Cache::forget($this->bnBreakingNewsCacheKey);
    }

}

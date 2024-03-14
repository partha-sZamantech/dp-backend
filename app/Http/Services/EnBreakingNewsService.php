<?php


namespace App\Http\Services;

use App\Models\EnBreakingNews;
use Illuminate\Support\Facades\Cache;

class EnBreakingNewsService
{
    public $enBreakingNewsCacheKey = 'enBreakingNewsCacheKey';

    public function getBreakingNews()
    {
        if (!Cache::has($this->enBreakingNewsCacheKey)) {
            $breakingNews = EnBreakingNews::query()
                ->select(['id', 'news_title', 'news_link', 'expired_time'])
                ->where('expired_time', '>', now())
                ->orderBy('position')
                ->get();

            if ($breakingNews->count()) {
                Cache::forever($this->enBreakingNewsCacheKey, $breakingNews);
            }

        } else {
            $breakingNews = Cache::get($this->enBreakingNewsCacheKey);
        }

        return $breakingNews;
    }

    public function clearCache()
    {
        Cache::forget($this->enBreakingNewsCacheKey);
    }

}
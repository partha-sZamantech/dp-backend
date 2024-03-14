<?php


namespace App\Http\Services;

use App\Models\BnAd;
use Illuminate\Support\Facades\Cache;

class AdManagementService
{
    public $commonAdsCacheKey = 'commonAdsCacheKey';
    public $homePageAdsCacheKey = 'homePageAdsCacheKey';
    public $categoryPageAdsCacheKey = 'categoryPageAdsCacheKey';
    public $detailsPageAdsCacheKey = 'detailsPageAdsCacheKey';

    public $dfpHeaderCodeCacheKey = 'dfpHeaderCodeCacheKey';

    public function getAllAds()
    {
        $allAds = BnAd::query()
            ->select(['id', 'type', 'page', 'position', 'dfp_header_code', 'code', 'desktop_image_path', 'mobile_image_path', 'external_link', 'start_time', 'end_time'])
            ->where('status', 1)
            ->where('deletable', 1)
            ->get();

        // 1 = Common, 2 = Home Page, 3 = Category Page, 4 = Details Page
        if (!Cache::has($this->commonAdsCacheKey)) {
            Cache::forever($this->commonAdsCacheKey, $allAds->where('page', 1));
        }
        if (!Cache::has($this->homePageAdsCacheKey)) {
            Cache::forever($this->homePageAdsCacheKey, $allAds->where('page', 2));
        }
        if (!Cache::has($this->categoryPageAdsCacheKey)) {
            Cache::forever($this->categoryPageAdsCacheKey, $allAds->where('page', 3));
        }
        if (!Cache::has($this->detailsPageAdsCacheKey)) {
            Cache::forever($this->detailsPageAdsCacheKey, $allAds->where('page', 4));
        }

        // DFP header code cache - 1=DFP, 2=Code, 3=Image
        if (!Cache::has($this->dfpHeaderCodeCacheKey)) {
            Cache::forever($this->dfpHeaderCodeCacheKey, $allAds->where('type', 1)->pluck('dfp_header_code'));
        }
    }

    public function clearAdsCache($ad)
    {
        $pageId = $ad->page;
        $type = $ad->type;

        // Clear DFP header code cache - 1=DFP, 2=Code, 3=Image
        if ($type == 1) {
            Cache::forget($this->dfpHeaderCodeCacheKey);
        }

        // 1 = Common, 2 = Home Page, 3 = Category Page, 4 = Details Page
        if ($pageId == 1) {
            Cache::forget($this->commonAdsCacheKey);
        } elseif ($pageId == 2) {
            Cache::forget($this->homePageAdsCacheKey);
        } elseif ($pageId == 3) {
            Cache::forget($this->categoryPageAdsCacheKey);
        } elseif ($pageId == 4) {
            Cache::forget($this->detailsPageAdsCacheKey);
        }
    }
}

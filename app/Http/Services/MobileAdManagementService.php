<?php


namespace App\Http\Services;

use App\Models\BnMobileAd;
use Illuminate\Support\Facades\Cache;

class MobileAdManagementService
{
    public $mobileCommonAdsCacheKey = 'mobileCommonAdsCacheKey';
    public $mobileHomePageAdsCacheKey = 'mobileHomePageAdsCacheKey';
    public $mobileCategoryPageAdsCacheKey = 'mobileCategoryPageAdsCacheKey';
    public $mobileDetailsPageAdsCacheKey = 'mobileDetailsPageAdsCacheKey';

    public $mobileDfpHeaderCodeCacheKey = 'mobileDfpHeaderCodeCacheKey';

    public function getAllAds()
    {
        $allAds = BnMobileAd::query()
            ->select(['id', 'type', 'page', 'position', 'dfp_header_code', 'code', 'mobile_image_path', 'external_link', 'start_time', 'end_time'])
            ->where('status', 1)
            ->where('deletable', 1)
            ->get();

        // 1 = Common, 2 = Home Page, 3 = Category Page, 4 = Details Page
        if (!Cache::has($this->mobileCommonAdsCacheKey)) {
            Cache::forever($this->mobileCommonAdsCacheKey, $allAds->where('page', 1));
        }
        if (!Cache::has($this->mobileHomePageAdsCacheKey)) {
            Cache::forever($this->mobileHomePageAdsCacheKey, $allAds->where('page', 2));
        }
        if (!Cache::has($this->mobileCategoryPageAdsCacheKey)) {
            Cache::forever($this->mobileCategoryPageAdsCacheKey, $allAds->where('page', 3));
        }
        if (!Cache::has($this->mobileDetailsPageAdsCacheKey)) {
            Cache::forever($this->mobileDetailsPageAdsCacheKey, $allAds->where('page', 4));
        }

        // DFP header code cache - 1=DFP, 2=Code, 3=Image
        if (!Cache::has($this->mobileDfpHeaderCodeCacheKey)) {
            Cache::forever($this->mobileDfpHeaderCodeCacheKey, $allAds->where('type', 1)->pluck('dfp_header_code'));
        }
    }

    public function clearAdsCache($ad)
    {
        $pageId = $ad->page;
        $type = $ad->type;

        // Clear DFP header code cache - 1=DFP, 2=Code, 3=Image
        if ($type == 1) {
            Cache::forget($this->mobileDfpHeaderCodeCacheKey);
        }

        // 1 = Common, 2 = Home Page, 3 = Category Page, 4 = Details Page
        if ($pageId == 1) {
            Cache::forget($this->mobileCommonAdsCacheKey);
        } elseif ($pageId == 2) {
            Cache::forget($this->mobileHomePageAdsCacheKey);
        } elseif ($pageId == 3) {
            Cache::forget($this->mobileCategoryPageAdsCacheKey);
        } elseif ($pageId == 4) {
            Cache::forget($this->mobileDetailsPageAdsCacheKey);
        }
    }
}

<?php

namespace App\Providers;

use App\Http\Services\AdManagementService;
use App\Http\Services\MobileAdManagementService;
use App\Models\BnSiteSettings;
use App\Models\EnSiteSettings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Bn site settings
        if (!Cache::has('bnSiteSettings')) {
            $bnSiteSettings = BnSiteSettings::first();
            Cache::forever('bnSiteSettings', $bnSiteSettings);
        }

        // En site settings
        if (!Cache::has('enSiteSettings')) {
            $enSiteSettings = EnSiteSettings::first();
            Cache::forever('enSiteSettings', $enSiteSettings);
        }

        // Get all ads
        (new AdManagementService())->getAllAds();

        // Get mobile all ads
        (new MobileAdManagementService())->getAllAds();
    }
}

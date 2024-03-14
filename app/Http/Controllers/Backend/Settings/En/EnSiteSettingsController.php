<?php

namespace App\Http\Controllers\Backend\Settings\En;

use App\Http\Controllers\Controller;
use App\Models\EnSiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EnSiteSettingsController extends Controller
{
    public function index(){
        $siteSettings = EnSiteSettings::first();
        return view('backend.settings.en.setting.en_site_settings', compact('siteSettings'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'siteName' => 'required',
            'logo' => 'mimes:jpeg,jpg,gif,png|max:150',
            'ogImage' => 'mimes:jpeg,jpg,png|dimensions:width=600,height=315|max:100'
        ]);

        $site_settings = EnSiteSettings::find(1);
        $site_settings->site_name = $request->siteName;
        $site_settings->title = $request->siteTitle;
        if ($request->hasFile('logo')) {
            $filename = 'en-logo'.time().'.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(config('appconfig.commonImagePath'), $filename);
            $site_settings->logo = $filename;
        }

        if ($request->hasFile('ogImage')) {
            $filename = 'en-og-default-'.time().'.' . $request->file('ogImage')->getClientOriginalExtension();
            $request->file('ogImage')->move(config('appconfig.commonImagePath'), $filename);
            $site_settings->og_image = $filename;
        }

        $site_settings->logo_header = $request->logoHeader == 'on' ? 1 : 2;
        $site_settings->logo_footer = $request->logoFooter == 'on' ? 1 : 2;
        $site_settings->meta_keywords = $request->metaKeyword;
        $site_settings->meta_description = $request->metaDescription;
        $site_settings->social_links = serialize(array_filter($request->socialLinks));
        $site_settings->editor_meta = $request->editorMeta;
        $site_settings->copyright = $request->copyright;
        $site_settings->address = $request->address;


        $site_settings->save();

        Cache::forget('bnSiteSettings');

        return redirect('backend/en-site-settings')->with('successMsg', 'The Bangla site settings has been updated!');
    }
}

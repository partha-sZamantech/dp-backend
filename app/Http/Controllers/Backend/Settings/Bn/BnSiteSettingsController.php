<?php

namespace App\Http\Controllers\Backend\Settings\Bn;

use App\Http\Controllers\Controller;
use App\Models\BnSiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BnSiteSettingsController extends Controller
{
    public function index(){
        $siteSettings = BnSiteSettings::first();
        return view('backend.settings.bn.setting.bn_site_settings', compact('siteSettings'));
    }

    public function store(Request $request){

        $this->validate($request, [
           'siteName' => 'required',
            'logo'    => 'mimes:jpeg,jpg,gif,png|max:50',
            'ogImage' => 'mimes:jpeg,jpg,png|dimensions:width=600,height=315|max:100'
        ]);

        $site_settings = BnSiteSettings::find(1);
        $site_settings->site_name           = $request->siteName;
        $site_settings->title               = $request->siteTitle;

        // Logo
        if ($request->hasFile('logo')){
            $filename = 'logo'.time().'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(config('appconfig.commonImagePath'), $filename);
            $site_settings->logo = $filename;
        }

        // Favicon
        if ($request->hasFile('favicon')){
            $faviconfilename = 'favicon'.time().'.'.$request->file('favicon')->getClientOriginalExtension();
            $request->file('favicon')->move(config('appconfig.commonImagePath'), $faviconfilename);
            $site_settings->favicon = $faviconfilename;
        }

        // OG Image
        if ($request->hasFile('ogImage')){
            $filename = 'og-default-'.time().'.'.$request->file('ogImage')->getClientOriginalExtension();
            $request->file('ogImage')->move(config('appconfig.commonImagePath'), $filename);
            $site_settings->og_image = $filename;
        }

        // Post OG Image
        if ($request->hasFile('post_ogimage')){
            $post_ogimagefilename = 'og-common'.'.'.$request->file('post_ogimage')->getClientOriginalExtension();
            $request->file('post_ogimage')->move(config('appconfig.ogImagePath'), $post_ogimagefilename);
            $site_settings->post_ogimage = $post_ogimagefilename;
        }

        $site_settings->logo_header         = $request->logoHeader == 'on' ? 1 : 2;
        $site_settings->logo_footer         = $request->logoFooter == 'on' ? 1 : 2;
        $site_settings->meta_keywords       = $request->metaKeyword;
        $site_settings->meta_description    = $request->metaDescription;
        $site_settings->social_links        = serialize(array_filter($request->socialLinks));
        $site_settings->facebook = $request->socialLinks['facebook'];
        $site_settings->twitter = $request->socialLinks['twitter'];
        $site_settings->google_plus = $request->socialLinks['google'];
        $site_settings->youtube = $request->socialLinks['youtube'];
        $site_settings->instagram = $request->socialLinks['instagram'];
        $site_settings->linkedin = $request->socialLinks['linkedin'];
        $site_settings->editor_meta         = $request->editorMeta;
        $site_settings->copyright           = $request->copyright;
        $site_settings->address             = $request->address;



        $site_settings->save();

        Cache::forget('bnSiteSettings');

        return redirect('backend/bn-site-settings')->with('successMsg', 'The Bangla site settings has been updated!');
    }
}

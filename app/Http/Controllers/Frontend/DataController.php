<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BnCategory;
use App\Models\BnContent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function rss($slug = null)
    {
        if ($slug != 'rss') {
            $key = 'bn-category-slug-' . $slug;
            if (Cache::has($key)) {
                $category = Cache::get($key);
            } else {
                $category = BnCategory::where('cat_slug', $slug)->where('status', 1)->where('deletable', 1)->first();
                Cache::forever($key, $category);
            }

            if (empty($category)) abort(404);

            $catId = $category->cat_id;
            $categoryName = $category->cat_name;
        }

        $key = 'rss-gnews-' . $slug;
        if (Cache::has($key)) {
            $contents = Cache::get($key);
        } else {
            $contents = BnContent::with('category', 'subcategory');
            if (!empty($catId)) $contents = $contents->where('cat_id', $catId);
            $limit = $slug == 'rss' ? 100 : 30;
            $contents = $contents->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc')->limit($limit)->get();

            Cache::put($key, $contents, Carbon::now()->addMinutes(5));
        }

        $body = '<?xml version="1.0" encoding="utf-8" ?>
        <rss version="2.0"
        xml:base="https://www.dhakaprokash24.com/"
        xmlns:atom="http://www.w3.org/2005/Atom"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:media="http://search.yahoo.com/mrss/"
        xmlns:content="http://purl.org/rss/1.0/modules/content/">
        <channel>
            <title>dhakaprokash24.com' . ($slug == 'rss' ? '' : ' | ' . ucwords($categoryName)) . ' | RSS Feed</title>
            <link>https://www.dhakaprokash24.com/' . ($slug == 'rss' ? 'rss' : $slug) . '/</link>
            <description>RSS news feed</description>
            <atom:link href="https://www.dhakaprokash24.com/rss/' . ($slug == 'rss' ? 'rss' : $slug) . '.xml" rel="self" type="application/rss+xml" />
            <dc:language>bn-BD</dc:language>
            <dc:creator>Dhaka Prokash(info@dhakaprokash24.com)</dc:creator>
			<dc:rights>Copyright ' . date('Y') . ' dhakaprokash24.com</dc:rights>
			<dc:date>' . date('Y-m-d') . 'T' . date('h:i:s+06:00') . '</dc:date>';
        foreach ($contents as $content) {
            $sHeading = $content->content_heading;
            $sImagePath = asset(config('appconfig.contentImagePath') . $content->img_bg_path);
            $details = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $content->content_details);
            $sBrief = strip_tags(html_entity_decode($details));
            $sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory ? $content->subcategory->subcat_slug : null), $content->content_type);

            $pubdate = date('D, d M Y H:i:s O', strtotime($content->created_at));
            $body .= '
            <item>
                <title>' . $sHeading . '</title>
                <link>' . $sURL . '</link>
                <description>' . addslashes($sBrief) . '</description>
                <pubDate>' . $pubdate . '</pubDate>
                <guid isPermaLink="false">' . $sURL . '</guid>
                <media:content medium="image" width="750" height="390" url="' . $sImagePath . '"/>
                <content:encoded><![CDATA[' . htmlentities(html_entity_decode($details)) . ']]></content:encoded>
            </item>';
        }
        $body .= '
        </channel>
        </rss>';

        return response($body)->header('Content-Type', 'text/xml');
    }
}

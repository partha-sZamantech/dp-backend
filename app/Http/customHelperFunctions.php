<?php

use Illuminate\Support\Facades\File;

function bnHeaderCategory()
{
    return \App\Models\BnCategory::where('cat_type', 1)->where('top_menu', 1)->where('status', 1)->where('deletable', 1)->orderBy('cat_position')->get();
}

function bnFooterCategory()
{
    return \App\Models\BnCategory::where('cat_type', 1)->where('footer_menu', 1)->where('status', 1)->where('deletable', 1)->orderBy('cat_position')->get();
}

function enHeaderCategory()
{
    return \App\Models\EnCategory::where('cat_type', 1)->where('top_menu', 1)->where('status', 1)->where('deletable', 1)->orderBy('cat_position')->get();
}

function enFooterCategory()
{
    return \App\Models\EnCategory::where('cat_type', 1)->where('footer_menu', 1)->where('status', 1)->where('deletable', 1)->orderBy('cat_position')->get();
}

function bnVideoCategory()
{
    return \App\Models\BnVideoCategory::select(['id', 'slug', 'name_bn'])->where('status', 1)->where('deletable', 1)->orderBy('id')->get();
}

function photoHeaderCategory()
{
    return \App\Models\PhotoCategory::where('top_menu', 1)->where('status', 1)->where('deletable', 1)->orderBy('cat_position')->get();
}

function fFormatUrl($content)
{
    $arrChars = [":", "‘", "’", "/", "'", "`", "?", "&", "%", "_", "(", ")", '"', "!", "-", ",", " "];
    $content = strip_tags(stripslashes(trim($content)));
    $rContent = strtolower(str_replace($arrChars, '-', $content));
    $rContent = str_replace('--', '-', $rContent);
    $rContent = str_replace('--', '-', $rContent);
    $rContent = html_entity_decode(trim($rContent, '-'));
    return $rContent;
}

function fFormatAddCommaToNumber($no)
{
    $str = (string)$no;
    if (strlen($str) > 3) {
        $str = substr_replace($str, ',', -3, 0);
    }
    if (strlen($str) > 6) {
        $str = substr_replace($str, ',', -6, 0);
    }
    if (strlen($str) > 9) {
        $str = substr_replace($str, ',', -9, 0);
    }

    return $str;
}

function fDesktopURL($ContentID, $CatSlug = null, $SubCatSlug = null, $ContentType = 1)
{
    $sURL = url(($CatSlug != null ? $CatSlug : "national") . "/" . ($SubCatSlug != null ? $SubCatSlug : ($ContentType == 2 ? "article" : "news")) . "/" . $ContentID);
    return $sURL;
}

function fEnRoot($path=null)
{
    return url('/english') . ($path != null ? '/'.$path : '');
}

function fEnURL($ContentID, $CatSlug = null, $SubCatSlug = null, $ContentType = 1)
{
    $sURL = url('/english/' . ($CatSlug != null ? $CatSlug : "national") . "/" . ($SubCatSlug != null ? $SubCatSlug : ($ContentType == 2 ? "article" : "news")) . "/" . $ContentID);
    return $sURL;
}

function fAlbumURL($albumID, $catSlug, $subCatSlug = null)
{
    $sURL = url('/photo/' . $catSlug . "/" . ($subCatSlug != null ? $subCatSlug : 'album') . "/". $albumID);
    return $sURL;
}

function fVideoURL($videoID, $catSlug = null, $subCatSlug = null)
{
    $sURL = url('/video/' . ($catSlug != null ? $catSlug . "/" : '') . ($subCatSlug != null ? $subCatSlug . "/" : '') . $videoID);
    return $sURL;
}

function fEnVideoURL($videoID, $catSlug = null, $subCatSlug = null)
{
    $sURL = url('/english/video/' . ($catSlug != null ? $catSlug . "/" : '') . ($subCatSlug != null ? $subCatSlug . "/" : '') . $videoID);
    return $sURL;
}

function fFormatImgBase64ToJPEG($base64_string, $output_file)
{
    $folderPath = config('appconfig.contentImagePath') . date('YF');

    if (!File::isDirectory($folderPath)) {
        File::makeDirectory($folderPath);
    }

    $file = explode('.', $output_file);
    $fileName = fFormatUrl($file[0]) . '-' . date("YmdHis") . '.' . $file[1];
    $outFile = $folderPath . '/' . $fileName;
    $data = explode(',', $base64_string);
    File::put($outFile, base64_decode($data[1]));
    return date('YF') . '/' .$fileName;
}

function fFormatDateEn2Bn($BDDate)
{
    //Convert a English date to Bangla date
    $en = array("AM", "PM", "am", "pm", "Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $bn = array("এএম", "পিএম", "এএম", "পিএম", "শনিবার", "রোববার", "সোমবার", "মঙ্গলবার", "বুধবার", "বৃহস্পতিবার", "শুক্রবার", "জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর", "০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯");
    $BDDate = str_replace($en, $bn, $BDDate);
    return $BDDate;
}

function fGetWord($string, $length)
{
    $aText = explode(' ', strip_tags($string));
    $aCount = count($aText);
    $rText = implode(' ', array_slice($aText, 0, $length));
    $rText .= $aCount > $length ? '...' : '';
    return $rText;
}


function getBnHeaderMenuContent()
{
    // Header Menu Contents
    $headerMenuPosition = App\Models\BnContentPosition::where('special_cat_id', 31)->where('deletable', 1)->first();
    if (!is_null($headerMenuPosition->content_ids)) {
        $aContentIDs = explode(",", $headerMenuPosition->content_ids);
        $aContentIDs = array_slice($aContentIDs, 0, 1);
        $sContentIDs = implode(',', $aContentIDs);
        $headerMenuContents = App\Models\BnContent::with('category', 'subcategory')->where('content_id', $sContentIDs)->where('status', 1)->where('deletable', 1)->first();
//            dd($headerMenuContents);

        return $headerMenuContents;
    }
}

function getEnHeaderMenuContent()
{
    // Header Menu Contents
    $headerMenuPosition = App\Models\EnContentPosition::where('special_cat_id', 31)->where('deletable', 1)->first();
    if (!is_null($headerMenuPosition->content_ids)) {
        $aContentIDs = explode(",", $headerMenuPosition->content_ids);
        $aContentIDs = array_slice($aContentIDs, 0, 1);
        $sContentIDs = implode(',', $aContentIDs);
        $headerMenuContents = App\Models\EnContent::with('category', 'subcategory')->where('content_id', $sContentIDs)->where('status', 1)->where('deletable', 1)->first();
//            dd($headerMenuContents);

        return $headerMenuContents;
    }
}

function fFormatString($string)
{
    //Ommits HTML Code from the texts
    $string = strip_tags($string);//Strip HTML and PHP tags from a string
    $string = str_replace("'", "`", $string);
    return html_entity_decode($string);
}

function fFormatDateAsMySQL($sDate)
{
    //Converts a date to MySQL data value YYYY-MM-DD
    //Workable for DatePicker or jQuery UI DatePicker
    $sDate = str_replace('/', '-', $sDate);
    $sDate = date("Y-m-d", strtotime($sDate));
    return $sDate;
}

function isMobile()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

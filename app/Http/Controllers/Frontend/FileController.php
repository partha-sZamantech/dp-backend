<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MonthlyFolder;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileController extends Controller
{

    public function nuxtOgImage($category, $path=null)
    {
        $items = request()->all();

        if (empty($items['amp;imgPath']) && empty($items['imgPath'])) {
            abort(404);
        } elseif (!empty($items['amp;imgPath'])) {
            $imgPath = $items['amp;imgPath'];
        } else {
            $imgPath = $items['imgPath'];
        }

        // Type - if type is video or photo
        if (!empty($items['amp;type'])) {
            $type = $items['amp;type'];
        } elseif(!empty($items['type'])) {
            $type = $items['type'];
        } else {
            // if type is none, it will set content image path
            $type = null;
        }

        if (!$imgPath) abort(404);

        $watermarkFile = '/media/ogImages/og-common.png';
        if (File::exists(getcwd().'/media/ogImages/og-' . $category . '.png')) {
            $watermarkFile = '/media/ogImages/og-' . $category . '.png';
        }

//        $watermarkFile = '/media/ogImages/newfacebook.jpg';
//        if (File::exists(getcwd().'/media/ogImages/og-' . $category . '.jpg')) {
//            $watermarkFile = '/media/ogImages/og-' . $category . '.jpg';
//        }

        $aImg = explode('.', $imgPath);
        $imgExt = $aImg[count($aImg) - 1];

        if (!in_array($imgExt, ['jpg', 'jpeg', 'png', 'gif'])) abort(404);
//        if (!Storage::exists('media/content/images/' . $imgPath)) abort(404);

        // Load the logo stamp and the photo to apply the watermark to
        $imgFunc = $imgExt == 'png' ? 'imagecreatefrompng' : ($imgExt == 'gif' ? 'imagecreatefromgif' : 'imagecreatefromjpeg');

        $logo = imagecreatefrompng(getcwd().$watermarkFile);
        $path = $type == 'video' ? config('appconfig.videoImagePath') : ($type == 'photo' ? config('appconfig.photoAlbumImagePath') : config('appconfig.contentImagePath'));

        $img = $imgFunc(getcwd().'/'.$path.$imgPath);

        // Set the margins for the stamp and get the height/width of the stamp image
        $marge_right = 0;
        $marge_bottom = 0;
        $logox = imagesx($logo);
        $logoy = imagesy($logo);
        $imgx = imagesx($img);
        $imgy = imagesy($img);

        // width to calculate positioning of the stamp.
        imagecopy($img, $logo, $imgx - $logox - $marge_right, $imgy - $logoy - $marge_bottom, 0, 0, $logox, $logoy);

        // Output and free memory
        header('Content-type: image/jpeg');
        imagejpeg($img);

        imagedestroy($img);
    }


    public function getOG($category, $path=null)
    {
        $items = request()->all();

        if (empty($items['amp;imgPath']) && empty($items['imgPath'])) {
            abort(404);
        } elseif (!empty($items['amp;imgPath'])) {
            $imgPath = $items['amp;imgPath'];
        } else {
            $imgPath = $items['imgPath'];
        }

        // Type - if type is video or photo
        if (!empty($items['amp;type'])) {
            $type = $items['amp;type'];
        } elseif(!empty($items['type'])) {
            $type = $items['type'];
        } else {
            // if type is none, it will set content image path
            $type = null;
        }

        if (!$imgPath) abort(404);

        $watermarkFile = '/media/ogImages/og-common.png';
        if (File::exists(getcwd().'/media/ogImages/og-' . $category . '.png')) {
            $watermarkFile = '/media/ogImages/og-' . $category . '.png';
        }

//        $watermarkFile = '/media/ogImages/newfacebook.jpg';
//        if (File::exists(getcwd().'/media/ogImages/og-' . $category . '.jpg')) {
//            $watermarkFile = '/media/ogImages/og-' . $category . '.jpg';
//        }

        $aImg = explode('.', $imgPath);
        $imgExt = $aImg[count($aImg) - 1];

        if (!in_array($imgExt, ['jpg', 'jpeg', 'png', 'gif'])) abort(404);
//        if (!Storage::exists('media/content/images/' . $imgPath)) abort(404);

        // Load the logo stamp and the photo to apply the watermark to
        $imgFunc = $imgExt == 'png' ? 'imagecreatefrompng' : ($imgExt == 'gif' ? 'imagecreatefromgif' : 'imagecreatefromjpeg');

        $logo = imagecreatefrompng(getcwd().$watermarkFile);
        $path = $type == 'video' ? config('appconfig.videoImagePath') : ($type == 'photo' ? config('appconfig.photoAlbumImagePath') : config('appconfig.contentImagePath'));

        $img = $imgFunc(getcwd().'/'.$path.$imgPath);

        // Set the margins for the stamp and get the height/width of the stamp image
        $marge_right = 0;
        $marge_bottom = 0;
        $logox = imagesx($logo);
        $logoy = imagesy($logo);
        $imgx = imagesx($img);
        $imgy = imagesy($img);

        // width to calculate positioning of the stamp.
        imagecopy($img, $logo, $imgx - $logox - $marge_right, $imgy - $logoy - $marge_bottom, 0, 0, $logox, $logoy);

        // Output and free memory
        header('Content-type: image/jpeg');
        imagejpeg($img);

        imagedestroy($img);
    }






}

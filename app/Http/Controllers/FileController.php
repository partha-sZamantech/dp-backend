<?php

namespace App\Http\Controllers;

use App\Models\MonthlyFolder;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FileController extends Controller
{

    public function lastThreeMonths()
    {
        $lastThreeMonths = MonthlyFolder::select('folder_name')->orderBy('id', 'desc')->take(3)->get()->toArray();
        $lastThreeMonths = array_flatten($lastThreeMonths);
        //$lastThreeMonths=array('2017April', '2017May');
        return $lastThreeMonths;
    }

    public function existingExSMImg()
    {
        $mFolders = $this->lastThreeMonths();
        $response = [];

        foreach ($mFolders as $key => $mFolder) {
            $dir = "media/content/images/" . $mFolder . "/EXSM"; //convert to object
            $response = array_merge($response, $this->scan($dir));
        }
        //$response = array_merge($response, $response2, $response3);
//        $expiresAt = Carbon::now()->addMinute(10);
//        Cache::put('existingSMImgforlastThreeMonths', $response, $expiresAt);
        return array("name" => "files", "type" => "folder", "path" => "media/content/images", "items" => $response);
    }

    public function existingSMImg()
    {
        $mFolders = $this->lastThreeMonths();
        $response = [];

        foreach ($mFolders as $key => $mFolder) {
            $dir = "media/content/images/" . $mFolder . "/SM"; //convert to object
            $response = array_merge($response, $this->scan($dir));
        }
        //$response = array_merge($response, $response2, $response3);
//        $expiresAt = Carbon::now()->addMinute(10);
//        Cache::put('existingSMImgforlastThreeMonths', $response, $expiresAt);
        return array("name" => "files", "type" => "folder", "path" => "media/content/images", "items" => $response);
    }

    public function existingBGImg()
    {
        $mFolders = $this->lastThreeMonths();
        $response = [];

        foreach ($mFolders as $key => $mFolder) {
            $dir = "media/content/images/" . $mFolder; //convert to object
            $response = array_merge($response, $this->scan($dir));
        }

        return array("name" => "files", "type" => "folder", "path" => "media/content/images", "items" => $response);
    }


    private function scan($dir)
    {
        $files = array();
        // Is there actually such a folder/file?
        if (file_exists($dir)) {
            foreach (scandir($dir) as $f) {
                if (!$f || $f[0] == '.') {
                    continue; // Ignore hidden files
                }
                $files[] = array("name" => $f, "type" => "file", "path" => $dir . '/' . $f, "size" => filesize($dir . '/' . $f) // Gets the size of this file
                );

                /*if(is_dir($dir . '/' . $f)) {
                    // The path is a folder
                    $files[] = array(
                        "name" => $f,
                        "type" => "folder",
                        "path" => $dir . '/' . $f,
                        "items" => $this->scan($dir . '/' . $f) // Recursively get the contents of the folder
                    );
                }
                else {
                    // It is a file
                    $files[] = array(
                        "name" => $f,
                        "type" => "file",
                        "path" => $dir . '/' . $f,
                        "size" => filesize($dir . '/' . $f) // Gets the size of this file
                    );
                }*/
            }
        }
        return $files;
    }

    public static function fileUpload($file, $path)
    {
        $ext = $file->getClientOriginalExtension(); // Get extension
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Get file basename
        $basename = fFormatUrl($basename);
        $fileName = $basename . '-' . date("YmdHis") . '.' . $ext;
        $inputPath = $path . date('YF') . '/' ;
        $fileMove = $file->move($inputPath, $fileName);

        if ($fileMove) {
            $filePath = date('YF') . '/' . $fileName;
            return $filePath;
        }
    }

    public static function imageIntervention($file, $path, $width = null, $height = null, $type = null, $ratioWise = false)
    {
        $ext = $file->getClientOriginalExtension(); // Get extension
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Get file basename

        $fileName = fFormatUrl($basename) . '-' . date("YmdHis") . '.' . $ext;

        $imgPath = date('YF') . '/' . $type;

        $path = $path . $imgPath;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path);
        }
//        dd(File::isDirectory($path));

        $upload = Image::make($file);
        if ($ratioWise) {
            $upload = $upload->resize($width, $height, function ($const) {
                $const->aspectRatio();
            });
        } else {
            $upload = $upload->resize($width, $height);
        }

        $succ = $upload->save($path . $fileName);


        if ($succ) {
            return $imgPath . $fileName;
        }

    }

    public static function magazinePageUpload($file, $path, $fname=null, $width = null, $height = null, $type = null, $ratioWise = false)
    {
        $ext = $file->getClientOriginalExtension(); // Get extension
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Get file basename

        $fileName = ($fname ?? $basename . '-' . date("YmdHis")) . '.' . $ext;

        $magPath = config('appconfig.magazineImagePath').$path;
        $pagePath = $magPath.'pages/';
        if (!File::isDirectory($magPath)) {
            File::makeDirectory($magPath);
        }

        if (!File::isDirectory($pagePath)) {
            File::makeDirectory($pagePath);
        }

        $upload = Image::make($file);
        if ($ratioWise) {
            $upload = $upload->resize($width, $height, function ($const) {
                $const->aspectRatio();
            });
        } else {
            $upload = $upload->resize($width, $height);
        }

        $succ = $upload->save($pagePath . $fileName);


        if ($succ) {
            return $path .'pages/'. $fileName;
        }

    }

    public static function epaperPageUpload($file, $path, $fname=null, $width = null, $height = null, $type = null, $ratioWise = false)
    {
        $ext = $file->getClientOriginalExtension(); // Get extension
        $basename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Get file basename

        $fileName = ($fname ?? $basename . '-' . date("YmdHis")) . '.' . $ext;

        $magPath = config('appconfig.epaperImagePath').$path;
        $pagePath = $magPath.'pages/';
        if (!File::isDirectory($magPath)) {
            File::makeDirectory($magPath);
        }

        if (!File::isDirectory($pagePath)) {
            File::makeDirectory($pagePath);
        }

        $upload = Image::make($file);
        if ($ratioWise) {
            $upload = $upload->resize($width, $height, function ($const) {
                $const->aspectRatio();
            });
        } else {
            $upload = $upload->resize($width, $height);
        }

        $succ = $upload->save($pagePath . $fileName);


        if ($succ) {
            return $path .'pages/'. $fileName;
        }

    }

    public static function deleteFile($path, $file)
    {
        if (file_exists(public_path() . '/' . $path . $file)) {
            \File::delete(public_path() . '/' . $path . $file);
        }

        return true;
    }

    public static function base64ToJpeg($base64_string, $output_file, $path, $monthlyFolder)
    {
        $file = explode('.', $output_file);
        $output_file = $monthlyFolder . $file[0] . '-' . date("YmdHis") . '.' . $file[1];
        $file = $path . $output_file;
        $data = explode(',', $base64_string);
        File::put($file, base64_decode($data[1]));
        return $output_file;
    }


}

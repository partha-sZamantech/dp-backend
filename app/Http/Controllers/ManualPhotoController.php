<?php

namespace App\Http\Controllers;

use App\Models\ManualPhoto;
use Illuminate\Http\Request;

class ManualPhotoController extends Controller
{
    private  $sMonthlyImageFolder;

    public function __construct(){
        $this->sMonthlyImageFolder=MonthlyFolderController::getLastMonthlyFolder().'/';
    }

    public function index()
    {
        $photos = ManualPhoto::where('deletable', 1)->orderBy('photo_id', 'desc')->get();

        return view('backend.manualphoto.manual_photo_list', compact('photos'));
    }

    public function create()
    {
        return view('backend.manualphoto.manual_photo_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['manualPhoto' => 'required|mimes:jpeg,jpg,gif,png']);

        $photo = new ManualPhoto();
        if($request->hasFile('manualPhoto')){
            $finalPhotoPath = FileController::fileUpload($request->manualPhoto, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder);

            $photo->img_path = $finalPhotoPath;
        }

        $photo->save();

        return redirect('backend/manual-photos')->with('successMsg', 'The photo has been uploaded successfully!');
    }

    public function edit($id)
    {
        $photo = ManualPhoto::find($id);

        return view('backend.manualphoto.manual_photo_edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['manualPhoto' => 'required|mimes:jpeg,jpg,gif,png']);

        $photo = ManualPhoto::find($id);
        if($request->hasFile('manualPhoto')){
            $finalPhotoPath = FileController::fileUpload($request->manualPhoto, config('appconfig.contentImagePath'), $this->sMonthlyImageFolder);

            $photo->img_path = $finalPhotoPath;
        }

        $photo->save();

        return redirect('backend/manual-photos')->with('successMsg', 'The photo has been changed successfully!');
    }

    public function destroy($id)
    {
        ManualPhoto::where('photo_id', $id)->update(['deletable' => 2]);

        return redirect('backend/manual-photos')->with('successMsg', 'The photo has been removed successfully!');
    }

    public function attachPhotoUpload(Request $request){
        $filename = $request->filename;
        $fileString = explode(':', $request->imagevalue);
        if ($fileString[0] == 'data' && isset($filename)) {
            $finalImagePath = fFormatImgBase64ToJPEG($request->imagevalue, $filename);
            return $finalImagePath;
        }
    }
}

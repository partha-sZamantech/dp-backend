<?php

namespace App\Http\Controllers;

use App\Models\MonthlyFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MonthlyFolderController extends Controller
{
    public static function getLastMonthlyFolder(){
        $lastFolder = MonthlyFolder::select('folder_name')->orderBy('folder_id', 'desc')->first()->folder_name;
        return $lastFolder;
    }

    public function index()
    {
        $folders = MonthlyFolder::where('deletable', 1)->get();
        return view('backend.settings.monthly-folder.monthly_folder_list', compact('folders'));
    }

    public function create()
    {
        return view('backend.settings.monthly-folder.monthly_folder_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['folder_name' => 'required|unique:monthly_folders']);

        $folder = new MonthlyFolder();
        $folder->folder_name = $request->folder_name;
        File::makeDirectory(config('appconfig.contentImagePath').$request->folder_name, 0755);
        File::makeDirectory(config('appconfig.contentImagePath').$request->folder_name.'/SM', 0755);
        File::makeDirectory(config('appconfig.contentImagePath').$request->folder_name.'/XS', 0755);
        File::makeDirectory(config('appconfig.photoAlbumImagePath').$request->folder_name, 0755);
        File::makeDirectory(config('appconfig.photoGalleryImagePath').$request->folder_name, 0755);
        File::makeDirectory(config('appconfig.contentDocumentPath').$request->folder_name, 0755);
        File::makeDirectory(config('appconfig.readersContentImagePath').$request->folder_name, 0755);
        $folder->save();


        return redirect('backend/monthly-folders')->with('successMsg', 'The monthly folder has been created successfully!');
    }

    public function edit($id)
    {
        $folder = MonthlyFolder::find($id);

        return view('backend.settings.monthly-folder.monthly_folder_edit', compact('folder'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['folder_name' => 'required']);

        $folder = MonthlyFolder::find($id);
        $folder->folder_name = $request->folder_name;
        File::makeDirectory(config('appconfig.contentImagePath').$request->folder_name, 0755);
        File::makeDirectory(config('appconfig.contentImagePath').$request->folder_name.'/SM', 0755);
        File::makeDirectory(config('appconfig.contentImagePath').$request->folder_name.'/XS', 0755);
        File::makeDirectory(config('appconfig.photoAlbumImagePath').$request->folder_name, 0755);
        File::makeDirectory(config('appconfig.photoGalleryImagePath').$request->folder_name, 0755);
        File::makeDirectory(config('appconfig.contentDocumentPath').$request->folder_name, 0755);
        File::makeDirectory(config('appconfig.readersImagePath').$request->folder_name, 0755);
        $folder->save();

        return redirect('backend/monthly-folders')->with('successMsg', 'The monthly folder has been updated successfully!');
    }

    public function destroy($id)
    {
        MonthlyFolder::where('folder_id', $id)->update(['deletable' => 2]);
        return redirect('backend/monthly-folders')->with('successMsg', 'The monthly folder has been removed successfully!');
    }
}

<?php

namespace App\Http\Controllers\Backend\Photo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Frontend\PhotoFrontendController;
use App\Models\PhotoAlbum;
use App\Models\PhotoGallery;
use App\Models\PhotoCategory;
use Illuminate\Http\Request;

class PhotoAlbumController extends Controller
{

    public function index(Request $request)
    {
        $albums = PhotoAlbum::with(['category', 'uploader:id,name']);

        if ($request->catId) {
            $albums = $albums->where('cat_id', $request->catId);
        }

        if ($request->date) {
            $date   = fFormatDateAsMySQL($request->date);
            $albums = $albums->where('created_at', 'like', '%' . trim($date) . '%');
        }

        if ($request->searchBy == 1) { // Search content with ID
            $albums = $albums->where('album_id', trim($request->keyword));
        } elseif ($request->searchBy == 2) { // Search content with Heading
            $albums = $albums->where('album_name', 'like', '%' . trim($request->keyword) . '%');
        } elseif ($request->searchBy == 3) { // Search content with Writer
            $albums = $albums->where('photographer_name', 'like', '%' . trim($request->keyword) . '%');
        } elseif ($request->searchBy == 4) {
            $albums = $albums->where('top_home', 1);
        }

        $albums = $albums->where('deletable', 1)->orderBy('album_id', 'desc')->paginate(12);

        $categories = PhotoCategory::select('cat_id', 'cat_name_bn')->where('status', 1)->where('deletable', 1)->get();

        return view('backend.photo.photo_album_list', compact('albums', 'categories'));
    }

    public function create()
    {
        $categories = PhotoCategory::select('cat_id', 'cat_name_bn')->where('status', 1)->where('deletable', 1)->get();
        return view('backend.photo.create_photo_album', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'albumName'        => 'required',
            'photo'            => 'required',
            'photo.*'          => 'required|mimes:jpg,jpeg,png,gif,webp|dimensions:width=750,height=480|max:150',
            'shortDescription' => 'required | string',
            'status'           => ['required', 'regex:/[0-9]/']
        ]);

//        $album                    = new PhotoAlbum();
//        $album->cat_id            = $request->category;
//        $album->album_name        = $request->albumName;
//        $album->short_description = $request->shortDescription;
        $imgPaths = [];
        if ($request->hasFile('photo')) {
            $imgs     = $request->photo;

            foreach ($imgs as $k => $img) {
                $finalPhotoPath               = FileController::imageIntervention($img, config('appconfig.photoAlbumImagePath'), 750, 480);
                $imgPaths[$k]['img']          = $finalPhotoPath;
                $imgPaths[$k]['featureImage'] = $request->featureImage[$k] ?? '';
                $imgPaths[$k]['caption']      = $request->photoCaption[$k];
            }
//            $finalPhotoPath = FileController::fileUpload($request->albumPhoto, config('appconfig.photoAlbumImagePath'), $this->sMonthlyImageFolder);

        }
//        $album->album_details = serialize($imgPaths);
////        $album->tag                 = $request->normalTags;
//        $album->photographer_name = $request->photographerName;
//        $album->status            = $request->status;
//        $album->user_id           = auth()->id();
//        $album->save();

        $albumId = PhotoAlbum::insertGetId([
            'cat_id' => $request->category,
            'album_name' => $request->albumName,
            'short_description' => $request->shortDescription,
            'album_details' => serialize($imgPaths),
            'photographer_name' => $request->photographerName,
            'status' => $request->status,
            'user_id' => auth()->id(),
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);


        //  Insert Photo Gallery
            $gimgs = $request->photo;
            foreach ($gimgs as $key => $gm){
                $gallery = new PhotoGallery();
                $gallery->album_id = $albumId;
                $gallery->photo = $imgPaths[$key]['img'];
                $gallery->photo_capture = $imgPaths[$key]['caption'];
                $gallery->feature_image = $request->featureImage[$k] ?? '';
                $gallery->save();
            }



        // Clear home page cache
        (new PhotoFrontendController())->clearPhotoHomePageContentCache();

        return redirect('backend/photo-albums')->with('successMsg', 'The album has been inserted successfully!');
    }

    public function edit($id)
    {
        $categories = PhotoCategory::select('cat_id', 'cat_name_bn')->where('status', 1)->where('deletable', 1)->get();
        $album      = PhotoAlbum::with('category')->where('album_id', $id)->first();

        return view('backend.photo.edit_photo_album', compact('categories', 'album'));
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $this->validate($request, [
            'albumName'        => 'required',
            'photo.*'          => 'required|mimes:jpg,jpeg,png,gif|dimensions:width=750,height=480|max:150',
            'shortDescription' => 'required | string',
            'status'           => ['required', 'regex:/[0-9]/']
        ]);

        $album = PhotoAlbum::find($id);

        $album->cat_id            = $request->category;
        $album->album_name        = $request->albumName;
        $album->short_description = $request->shortDescription;
        $album_details            = $album->album_details;
        $imgPaths = [];
        foreach ($album_details as $key => $img) {
            if (isset($request->photoCaption[$key])) {
                $imgPaths[$key]['img'] = $album_details[$key]['img'];
                $imgPaths[$key]['featureImage'] = $key == array_keys($request->featureImage)[0] ? 2 : '';
                $imgPaths[$key]['caption']      = $request->photoCaption[$key];
            }
        }

        if ($request->hasFile('photo')) {
            $imgs = $request->photo;

            foreach ($imgs as $k => $img) {
                $finalPhotoPath               = FileController::imageIntervention($img, config('appconfig.photoAlbumImagePath'), 750, 480);
                $imgPaths[$k]['img']          = $finalPhotoPath;
                $imgPaths[$k]['featureImage'] = $request->featureImage[$k] ?? '';
                $imgPaths[$k]['caption']      = $request->photoCaption[$k];
            }
        }

        $album->album_details     = serialize($imgPaths);
        $album->photographer_name = $request->photographerName;
//        $album->tag                 = $request->normalTags;
        $album->status = $request->status;
//        $album->user_id = auth()->id();
        $updated = $album->save();

        if($updated){
            $existPhoto = PhotoGallery::where('album_id', $id)->first();
            if($existPhoto){
                PhotoGallery::where('album_id', $id)->delete();


                //  Insert Photo Gallery
                $gimgs = $request->photo;
                if($gimgs){
                    foreach ($gimgs as $key => $gm){
                        $gallery = new PhotoGallery();
                        $gallery->album_id = $id;
                        $gallery->photo = $imgPaths[$key]['img'];
                        $gallery->photo_capture = $imgPaths[$key]['caption'];
                        $gallery->feature_image = $request->featureImage[$k] ?? '';
                        $gallery->save();
                    }
                }else{

                    foreach ($album_details as $f => $fm){
                        $gallery = new PhotoGallery();
                        $gallery->album_id = $id;
                        $gallery->photo = $album_details[$f]['img'];
                        $gallery->photo_capture = $request->photoCaption[$f];
                        $gallery->feature_image = $request->featureImage[$f] ?? '';
                        $gallery->save();
                    }
                }
            }else{

                //  Insert Photo Gallery
                $gimgs = $request->photo;
                if($gimgs){
                    foreach ($gimgs as $key => $gm){
                        $gallery = new PhotoGallery();
                        $gallery->album_id = $id;
                        $gallery->photo = $imgPaths[$key]['img'];
                        $gallery->photo_capture = $imgPaths[$key]['caption'];
                        $gallery->feature_image = $request->featureImage[$k] ?? '';
                        $gallery->save();
                    }
                }else{

                    foreach ($album_details as $f => $fm){
                        $gallery = new PhotoGallery();
                        $gallery->album_id = $id;
                        $gallery->photo = $album_details[$f]['img'];
                        $gallery->photo_capture = $request->photoCaption[$f];
                        $gallery->feature_image = $request->featureImage[$f] ?? '';
                        $gallery->save();
                    }
                }

            }

        }


        // Clear home page cache
        (new PhotoFrontendController())->clearPhotoHomePageContentCache();

        return redirect('backend/photo-albums')->with('successMsg', 'The album has been updated successfully!');
    }

    public function destroy($id)
    {
        if (is_numeric($id)) {
            PhotoAlbum::where('album_id', $id)->update(['deletable' => 2]);
            PhotoGallery::where('album_id', $id)->delete();
            return redirect('backend/photo-albums')->with('successMsg', 'The album has been removed successfully!');
        }
    }
}

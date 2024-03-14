<?php

namespace App\Http\Controllers\Backend\Photo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\BnFrontendController;
use App\Models\PhotoAlbum;
use App\Models\PhotoAlbumPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoAlbumPositionController extends Controller
{
    public function index()
    {
        $content_positions = PhotoAlbumPosition::where('deletable', 1)->get();

        return view('backend.photo.position.album_position_list', compact('content_positions'));
    }

    public function create()
    {
        return view('backend.photo.position.album_position_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'position_name' => 'required|unique:p_album_positions',
            'category_id'   => 'unique:p_album_positions,cat_id'
        ]);

        $news_position                 = new PhotoAlbumPosition();
        $news_position->position_name  = $request->position_name;
        $news_position->position_slug  = fFormatURL($request->position_name);
        $news_position->cat_id         = $request->category_id;
        $news_position->special_cat_id = $request->special_cat_id;
        $news_position->subcat_id      = $request->subcat_id;
        $news_position->total_content  = $request->totalContent;
        $news_position->status         = $request->status;
        $news_position->save();

        return redirect('backend/photo-album-positions')->with('successMsg', 'The album position has been inserted successfully!');
    }

    public function edit($id)
    {
        $position = PhotoAlbumPosition::find($id);

        return view('backend.photo.position.album_position_edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'position_name' => 'required',
            'category_id'   => 'nullable:p_album_positions,cat_id,' . $id . ',position_id'
        ]);

        $news_position                 = PhotoAlbumPosition::find($id);
        $news_position->position_name  = $request->position_name;
        $news_position->position_slug  = fFormatURL($request->position_name);
        $news_position->cat_id         = $request->category_id;
        $news_position->special_cat_id = $request->special_cat_id;
        $news_position->subcat_id      = $request->subcat_id;
        $news_position->total_content  = $request->totalContent;
        $news_position->status         = $request->status;
        $news_position->save();

        return redirect('backend/photo-album-positions')->with('successMsg', 'The album position has been updated successfully!');
    }

    public function destroy($id)
    {
        if (is_numeric($id)) {
            PhotoAlbumPosition::where('position_id', $id)->update(['deletable' => 2]);

            return redirect('backend/photo-album-positions')->with('successMsg', 'The album position has been removed successfully!');
        }
    }

    public function getChangePosition($id)
    {
        $allpositions   = PhotoAlbumPosition::where('deletable', 1)->get();
        $album_position = PhotoAlbumPosition::find($id);
        $allAlbums        = '';
        if (!empty($album_position->content_ids)) {
            $content_ids = explode(',', $album_position->content_ids);

            $allAlbums = PhotoAlbum::select('album_id', 'album_name')->whereIn('album_id', $content_ids)->orderByRaw(DB::raw("FIELD(album_id, $album_position->content_ids)"))->get();
        }

        return view('backend.photo.position.album_position_set', compact('allpositions', 'allAlbums', 'album_position'));
    }

    public function autocompletePhotoAlbumSearch(Request $request){ // Autocomplete news search for news position
        $term = $request->term.'%';
        $data = PhotoAlbum::select('album_id', 'album_name', 'created_at')
                         ->where('deletable', 1)
                         ->where('album_id', 'like', $term)
                         ->orWhere('album_name', 'like', $term)
                         ->take(50)->get();
        $return_array = [];

        foreach ($data as $v) {
            $return_array[] = array('value' => $v->album_id . ' - ' . $v->album_name . ' - (' . $v->created_at .')' , 'id' =>$v->album_id);
        }

        return $return_array;
    }

    public function changePosition(Request $request){
        $data = [];
        parse_str($request->data, $data);
        $position = PhotoAlbumPosition::find($request->id);

        $position->content_ids = implode(',', array_slice($data['item'], 0, $position->total_content+5));
        $position->save();

        // Clear the home page cache
        (new BnFrontendController())->clearHomePageContentCache();

        return $position;
    }

    public function populatePosition(Request $request){
        $album_position = PhotoAlbumPosition::find($request->position);
        if($album_position->content_ids) {
            $content_ids = explode(',', $album_position->content_ids);
            $allAlbums = PhotoAlbum::select('album_id', 'album_name')->whereIn('album_id', $content_ids)->orderByRaw(DB::raw("FIELD(album_id, $album_position->content_ids)"))->get();

            return ['albums' => $allAlbums, 'position' => $album_position];
        }
    }
}

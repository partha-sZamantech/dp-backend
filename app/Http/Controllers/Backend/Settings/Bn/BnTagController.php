<?php

namespace App\Http\Controllers\Backend\Settings\Bn;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\BnTag;
use Illuminate\Http\Request;

class BnTagController extends Controller
{
    public function index(Request $request)
    {
        // Get search field values for pagination
        $exPartPagination = ["keyword" => $request->keyword];

        $tags = BnTag::where('deletable', 1);

        if ($request->exists('keyword')){ // Search tag name or slug
            $tags = $tags->where('tag_name', 'like', '%'.trim($request->keyword).'%')
                               ->orWhere('tag_slug', 'like', '%'.trim($request->keyword).'%');
        }

        $tags = $tags->latest()->paginate(20);

        return view('backend.settings.bn.tag.bn_tag_list', compact('tags', 'exPartPagination'));
    }

    public function create()
    {
        return view('backend.settings.bn.tag.bn_tag_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tagName' => 'required|unique:bn_tags,tag_name',
            'tagSlug' => 'required|unique:bn_tags,tag_slug'
        ]);

        $tag = new BnTag();

        $tag->tag_type = $request->tagType;
        $tag->tag_name = $request->tagName;
        $tag->tag_slug = fFormatUrl($request->tagSlug);
        $tag->description = $request->tagDescription;
        if($request->hasFile('tagPhoto')){
            $finalPhotoPath = FileController::fileUpload($request->tagPhoto, config('appconfig.tagImagePath'));
            $tag->img_path = $finalPhotoPath;
        }
        $tag->approval = $request->approval;
        $tag->save();
        return redirect('backend/bn-tags')->with('successMsg', 'The Bangla tag has been inserted successfully!');
    }

    public function edit($id)
    {
        $tag = BnTag::find($id);
        return view('backend.settings.bn.tag.bn_tag_edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tagName' => 'required|unique:bn_tags,tag_name,'.$id.',tag_id',
            'tagSlug' => 'required|unique:bn_tags,tag_slug,'.$id.',tag_id'
        ]);

        $tag = BnTag::find($id);

        $tag->tag_type = $request->tagType;
        $tag->tag_name = $request->tagName;
        $tag->tag_slug = fFormatUrl($request->tagSlug);
        $tag->description = $request->tagDescription;
        if($request->hasFile('tagPhoto')){
            $finalPhotoPath = FileController::fileUpload($request->tagPhoto, config('appconfig.tagImagePath'));
            $tag->img_path = $finalPhotoPath;
        }
        $tag->approval = $request->approval;
        $tag->save();
        return redirect('backend/bn-tags')->with('successMsg', 'The Bangla tag has been updated successfully!');
    }

    public function destroy($id)
    {
        if (is_numeric($id)) {
            BnTag::where('tag_id', $id)->update(['deletable' => 2]);
            return redirect('backend/bn-tags')->with('successMsg', 'The Bangla tag has been removed successfully!');
        }
    }
}

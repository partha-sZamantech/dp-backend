<?php

namespace App\Http\Controllers\Backend\Settings\Bn;

use App\Http\Controllers\Controller;
use App\Models\BnVideoCategory;
use Illuminate\Http\Request;

class BnVideoCategoryController extends Controller
{
    public function index()
    {
        $categories = BnVideoCategory::where('deletable', 1)->orderBy('position')->get();
        return view('backend.settings.bn.video-category.category_list', compact('categories'));
    }

    public function create()
    {
        return view('backend.settings.bn.video-category.category_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'categoryName'      => 'required|unique:bn_video_categories,name',
            'categoryNameBn'    => 'required|unique:bn_video_categories,name_bn',
        ]);

        $category = new BnVideoCategory();

        $category->name             = $request->categoryName;
        $category->name_bn          = $request->categoryNameBn;
        $category->slug             = fFormatUrl($request->categoryName);
        $category->meta_keywords    = $request->metaKeywords;
        $category->meta_description = $request->metaDescription;
        $category->position         = $request->categoryPosition;
        $category->status           = $request->status;
        $category->user_id          = auth()->id();
        $category->save();

        return redirect('backend/bn-video-categories')->with('successMsg', 'The category has been added successfully!');
    }

    public function edit($id)
    {
        $category = BnVideoCategory::find($id);
        return view('backend.settings.bn.video-category.category_edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'categoryName'      => 'required|unique:bn_video_categories,name,'.$id.',id',
            'categoryNameBn'    => 'required|unique:bn_video_categories,name_bn,'.$id.',id'
        ]);

        $category = BnVideoCategory::find($id);

        $category->name             = $request->categoryName;
        $category->name_bn          = $request->categoryNameBn;
        $category->slug             = fFormatUrl($request->categoryName);
        $category->meta_keywords    = $request->metaKeywords;
        $category->meta_description = $request->metaDescription;
        $category->position         = $request->categoryPosition;
        $category->status           = $request->status;
        $category->save();

        return redirect('backend/bn-video-categories')->with('successMsg', 'The category has been updated successfully!');
    }

    public function destroy($id)
    {
        BnVideoCategory::where('id', $id)->update(['deletable' => 2]);
        return redirect('backend/bn-video-categories')->with('successMsg', 'The category has been removed successfully!');
    }
}

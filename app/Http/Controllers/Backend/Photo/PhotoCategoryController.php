<?php

namespace App\Http\Controllers\Backend\Photo;

use App\Http\Controllers\Controller;
use App\Models\PhotoCategory;
use Illuminate\Http\Request;

class PhotoCategoryController extends Controller
{
    public function index()
    {
        $categories = PhotoCategory::where('deletable', 1)->get();
        return view('backend.settings.photo.photo_category_list', compact('categories'));
    }

    public function create()
    {
        return view('backend.settings.photo.photo_category_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'categoryName'      => 'required',
            'categoryNameBn'    => 'required'
        ]);

        $category = new PhotoCategory();

        $category->cat_name             = $request->categoryName;
        $category->cat_name_bn          = $request->categoryNameBn;
        $category->cat_slug             = fFormatUrl($request->categoryName);
        $category->cat_meta_keyword     = $request->metaKeyword;
        $category->cat_meta_description = $request->metaDescription;
        $category->cat_position         = $request->categoryPosition;
        $category->top_menu             = $request->topMenu;
        $category->footer_menu          = $request->footerMenu;
        $category->status               = $request->status;
        $category->save();

        return redirect('backend/photo-categories')->with('successMsg', 'The category has been added successfully!');
    }

    public function edit($id)
    {
        $category = PhotoCategory::find($id);
        return view('backend.settings.photo.photo_category_edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'categoryName'      => 'required',
            'categoryNameBn'    => 'required'
        ]);

        $category = PhotoCategory::find($id);

        $category->cat_name             = $request->categoryName;
        $category->cat_name_bn          = $request->categoryNameBn;
        $category->cat_slug             = fFormatUrl($request->categoryName);
        $category->cat_meta_keyword     = $request->metaKeyword;
        $category->cat_meta_description = $request->metaDescription;
        $category->cat_position         = $request->categoryPosition;
        $category->top_menu             = $request->topMenu;
        $category->footer_menu          = $request->footerMenu;
        $category->status               = $request->status;
        $category->save();

        return redirect('backend/photo-categories')->with('successMsg', 'The category has been updated successfully!');
    }

    public function destroy($id)
    {
        if(is_numeric($id)){
            PhotoCategory::where('cat_id', $id)->update(['deletable' => 2]);
            return redirect('backend/photo-categories')->with('successMsg', 'The category has been removed successfully!');
        }
    }
}

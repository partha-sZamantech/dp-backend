<?php

namespace App\Http\Controllers\Backend\Settings\En;

use App\Http\Controllers\Controller;
use App\Models\EnCategory;
use Illuminate\Http\Request;

class EnCategoryController extends Controller
{
    public function index()
    {
        $categories = EnCategory::where('deletable', 1)->orderBy('cat_position')->get();
        return view('backend.settings.en.category.en_category_list', compact('categories'));

    }

    public function create()
    {
        return view('backend.settings.en.category.en_category_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'categoryName'      => 'required'
        ]);

        $category = new EnCategory();

        $category->cat_type             = $request->categoryType;
        $category->cat_name             = $request->categoryName;
        $category->cat_slug             = fFormatUrl($request->categoryName);
        $category->cat_meta_keyword     = $request->metaKeyword;
        $category->cat_meta_description = $request->metaDescription;
        $category->cat_position         = $request->categoryPosition;
        $category->top_menu             = $request->topMenu;
        $category->footer_menu          = $request->footerMenu;
        $category->status               = $request->status;
        $category->save();

        return redirect('backend/en-categories')->with('successMsg', 'The category has been added successfully!');
    }


    public function edit($id)
    {
        $category = EnCategory::find($id);
        return view('backend.settings.en.category.en_category_edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'categoryName'      => 'required'
        ]);

        $category = EnCategory::find($id);

        $category->cat_type             = $request->categoryType;
        $category->cat_name             = $request->categoryName;
        $category->cat_slug             = fFormatUrl($request->categoryName);
        $category->cat_meta_keyword     = $request->metaKeyword;
        $category->cat_meta_description = $request->metaDescription;
        $category->cat_position         = $request->categoryPosition;
        $category->top_menu             = $request->topMenu;
        $category->footer_menu          = $request->footerMenu;
        $category->status               = $request->status;
        $category->save();

        return redirect('backend/en-categories')->with('successMsg', 'The category has been updated successfully!');
    }

    public function destroy($id)
    {
        if (is_numeric($id)){
            EnCategory::where('cat_id', $id)->update(['deletable' => 2]);
            return redirect('backend/en-categories')->with('successMsg', 'The category has been removed successfully!');
        }
    }
}

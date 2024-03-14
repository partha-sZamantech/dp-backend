<?php

namespace App\Http\Controllers\Backend\Settings\Bn;

use App\Http\Controllers\Controller;
use App\Models\BnCategory;
use Illuminate\Http\Request;

class BnCategoryController extends Controller
{
    public function index()
    {
        $categories = BnCategory::where('deletable', 1)->orderBy('cat_position')->get();
        return view('backend.settings.bn.category.category_list', compact('categories'));
    }

    public function create()
    {
        return view('backend.settings.bn.category.category_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'categoryName'      => 'required|unique:bn_categories,cat_name',
            'categoryNameBn'    => 'required|unique:bn_categories,cat_name_bn'
        ]);

        $category = new BnCategory();

        $category->cat_type             = $request->categoryType;
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

        return redirect('backend/bn-categories')->with('successMsg', 'The category has been added successfully!');
    }

    public function edit($id)
    {
        $category = BnCategory::find($id);
        return view('backend.settings.bn.category.category_edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'categoryName'      => 'required|unique:bn_categories,cat_name,'.$id.',cat_id',
            'categoryNameBn'    => 'required|unique:bn_categories,cat_name_bn,'.$id.',cat_id'
        ]);

        $category = BnCategory::find($id);

        $category->cat_type             = $request->categoryType;
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

        return redirect('backend/bn-categories')->with('successMsg', 'The category has been updated successfully!');
    }

    public function destroy($id)
    {
        BnCategory::where('cat_id', $id)->update(['deletable' => 2]);
        return redirect('backend/bn-categories')->with('successMsg', 'The category has been removed successfully!');
    }
}

<?php

namespace App\Http\Controllers\Backend\Settings\En;

use App\Http\Controllers\Controller;
use App\Models\EnCategory;
use App\Models\EnSubcategory;
use Illuminate\Http\Request;

class EnSubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = EnSubcategory::with('category')->where('deletable', 1)->get();
        return view('backend.settings.en.subcategory.en_subcategory_list', compact('subcategories'));
    }

    public function create()
    {
        $categories = EnCategory::where('deletable', 1)->get();
        return view('backend.settings.en.subcategory.en_subcategory_create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subcategoryName'      => 'required'
        ]);

        $subcategory = new EnSubcategory();

        $subcategory->cat_id                    = $request->category;
        $subcategory->subcat_name               = $request->subcategoryName;
        $subcategory->subcat_slug               = fFormatUrl($request->subcategoryName);
        $subcategory->subcat_meta_keyword       = $request->metaKeyword;
        $subcategory->subcat_meta_description   = $request->metaDescription;
        $subcategory->subcat_position           = $request->subcategoryPosition;
        $subcategory->status                    = $request->status;
        $subcategory->save();

        return redirect('backend/en-subcategories')->with('successMsg', 'The subcategory has been added successfully!');
    }


    public function edit($id)
    {
        $categories = EnCategory::where('deletable', 1)->get();
        $subcategory = EnSubcategory::find($id);
        return view('backend.settings.en.subcategory.en_subcategory_edit', compact('categories', 'subcategory'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'subcategoryName'      => 'required'
        ]);

        $subcategory = EnSubcategory::find($id);

        $subcategory->cat_id                    = $request->category;
        $subcategory->subcat_name               = $request->subcategoryName;
        $subcategory->subcat_slug               = fFormatUrl($request->subcategoryName);
        $subcategory->subcat_meta_keyword       = $request->metaKeyword;
        $subcategory->subcat_meta_description   = $request->metaDescription;
        $subcategory->subcat_position           = $request->subcategoryPosition;
        $subcategory->status                    = $request->status;
        $subcategory->save();

        return redirect('backend/en-subcategories')->with('successMsg', 'The subcategory has been updated successfully!');
    }

    public function destroy($id)
    {
        if (is_numeric($id)){
            EnSubcategory::where('subcat_id', $id)->update(['deletable' => 2]);
            return redirect('backend/en-subcategories')->with('successMsg', 'The subcategory has been removed successfully!');
        }
    }

    public function subcatPopulate(Request $request)
    {
        $cat_id = $request->cat_id;
        $subcategories = EnSubcategory::where('cat_id', $cat_id)->where('deletable', 1)->get();
        return $subcategories;
    }
}

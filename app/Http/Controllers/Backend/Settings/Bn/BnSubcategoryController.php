<?php

namespace App\Http\Controllers\Backend\Settings\Bn;

use App\Http\Controllers\Controller;
use App\Models\BnCategory;
use App\Models\BnSubcategory;
use Illuminate\Http\Request;

class BnSubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = BnSubcategory::with('category')->where('deletable', 1)->get();
        return view('backend.settings.bn.subcategory.subcategory_list', compact('subcategories'));
    }

    public function create()
    {
        $categories = BnCategory::where('deletable', 1)->get();
        return view('backend.settings.bn.subcategory.subcategory_create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subcategoryName'      => 'required',
            'subcategoryNameBn'    => 'required'
        ]);

        $subcategory = new BnSubcategory();

        $subcategory->cat_id                    = $request->category;
        $subcategory->subcat_name               = $request->subcategoryName;
        $subcategory->subcat_name_bn            = $request->subcategoryNameBn;
        $subcategory->subcat_slug               = fFormatUrl($request->subcategoryName);
        $subcategory->subcat_meta_keyword       = $request->metaKeyword;
        $subcategory->subcat_meta_description   = $request->metaDescription;
        $subcategory->subcat_position           = $request->subcategoryPosition;
        $subcategory->status                    = $request->status;
        $subcategory->save();

        return redirect('backend/bn-subcategories')->with('successMsg', 'The subcategory has been added successfully!');
    }


    public function edit($id)
    {
        $categories = BnCategory::where('deletable', 1)->get();
        $subcategory = BnSubcategory::find($id);
        return view('backend.settings.bn.subcategory.subcategory_edit', compact('categories', 'subcategory'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'subcategoryName'      => 'required',
            'subcategoryNameBn'    => 'required'
        ]);

        $subcategory = BnSubcategory::find($id);

        $subcategory->cat_id                    = $request->category;
        $subcategory->subcat_name               = $request->subcategoryName;
        $subcategory->subcat_name_bn            = $request->subcategoryNameBn;
        $subcategory->subcat_slug               = fFormatUrl($request->subcategoryName);
        $subcategory->subcat_meta_keyword       = $request->metaKeyword;
        $subcategory->subcat_meta_description   = $request->metaDescription;
        $subcategory->subcat_position           = $request->subcategoryPosition;
        $subcategory->status                    = $request->status;
        $subcategory->save();

        return redirect('backend/bn-subcategories')->with('successMsg', 'The subcategory has been updated successfully!');
    }

    public function destroy($id)
    {
        BnSubcategory::where('subcat_id', $id)->update(['deletable' => 2]);

        return redirect('backend/bn-subcategories')->with('successMsg', 'The subcategory has been removed successfully!');
    }

    public function subcatPopulate(Request $request)
    {
        $cat_id = $request->cat_id;
        $subcategories = BnSubcategory::where('cat_id', $cat_id)->where('deletable', 1)->get();
        return $subcategories;
    }
}

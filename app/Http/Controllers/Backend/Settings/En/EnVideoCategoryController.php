<?php

namespace App\Http\Controllers\Backend\Settings\En;

use App\Http\Controllers\Controller;
use App\Models\EnVideoCategory;
use Illuminate\Http\Request;

class EnVideoCategoryController extends Controller
{
    public function index()
    {
        $categories = EnVideoCategory::where('deletable', 1)->orderBy('position')->get();
        return view('backend.settings.en.video-category.category_list', compact('categories'));
    }

    public function create()
    {
        return view('backend.settings.en.video-category.category_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'categoryName'      => 'required|unique:mysqlen.en_video_categories,name',
        ]);

        $category = new EnVideoCategory();

        $category->name             = $request->categoryName;
        $category->slug             = fFormatUrl($request->categoryName);
        $category->meta_keywords    = $request->metaKeywords;
        $category->meta_description = $request->metaDescription;
        $category->position         = $request->categoryPosition;
        $category->status           = $request->status;
        $category->user_id          = auth()->id();
        $category->save();

        return redirect('backend/en-video-categories')->with('successMsg', 'The category has been added successfully!');
    }

    public function edit($id)
    {
        $category = EnVideoCategory::find($id);
        return view('backend.settings.en.video-category.category_edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'categoryName'      => 'required|unique:mysqlen.en_video_categories,name,'.$id.',id',
        ]);

        $category = EnVideoCategory::find($id);

        $category->name             = $request->categoryName;
        $category->slug             = fFormatUrl($request->categoryName);
        $category->meta_keywords    = $request->metaKeywords;
        $category->meta_description = $request->metaDescription;
        $category->position         = $request->categoryPosition;
        $category->status           = $request->status;
        $category->save();

        return redirect('backend/en-video-categories')->with('successMsg', 'The category has been updated successfully!');
    }

    public function destroy($id)
    {
        EnVideoCategory::where('id', $id)->update(['deletable' => 2]);
        return redirect('backend/en-video-categories')->with('successMsg', 'The category has been removed successfully!');
    }
}

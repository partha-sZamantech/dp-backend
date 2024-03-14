<?php

namespace App\Http\Controllers\Backend\Settings\Bn;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MonthlyFolderController;
use App\Models\BnAuthor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BnAuthorController extends Controller
{
    public function __construct(){
        $this->sMonthlyImageFolder=MonthlyFolderController::getLastMonthlyFolder().'/';
    }

    public function index(Request $request)
    {
        // Get search field values for pagination
        $exPartPagination = ["author_type" => $request->author_type, "keyword" => $request->keyword];

        $authors = BnAuthor::where('deletable', 1);

        // Search author with TYPE
//        if ($request->exists('author_type') && $request->author_type != 'all') {
//            $authors = $authors->where('author_type', $request->author_type);
//        }

        if ($request->exists('keyword')){ // Search author name or initial
            $authors = $authors->where('author_name', 'like', '%'.trim($request->keyword).'%')
                    ->orWhere('author_name_bn', 'like', '%'.trim($request->keyword).'%')
                    ->orWhere('author_initial', 'like', '%'.trim($request->keyword).'%');
        }

        $authors = $authors->latest()->paginate(10);

        return view('backend.settings.bn.author.bn_author_list', compact('authors', 'exPartPagination'));
    }

    public function create()
    {
        return view('backend.settings.bn.author.bn_author_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'author_name'       => 'required',
            'author_name_bn'    => 'required',
            'author_slug'       => 'required|unique:authors',
            'author_initial'    => 'required|string|max:30|unique:authors',
            'author_initial_bn' => 'required',
            'author_image'      => 'mimes:jpg,jpeg,png|max:2048'
        ]);

        $author = new BnAuthor();
        $author->author_type        = $request->author_type;
        $author->author_name        = $request->author_name;
        $author->author_name_bn     = $request->author_name_bn;
        $author->author_slug        = fFormatUrl($request->author_slug);
        $author->author_initial     = $request->author_initial;
        $author->author_initial_bn  = $request->author_initial_bn;
        $author->author_bio         = $request->author_bio;
        $author->author_bio_bn      = $request->author_bio_bn;

        if($request->hasFile('author_image')){
            $ext = $request->file('author_image')->getClientOriginalExtension();
            $filename = $author->author_slug . '-' . date("YmdHis") .'.'. $ext;
            $request->file('author_image')->move(config('appconfig.authorImagePath'), $filename);
            $author->img_path = $filename;
        }

        $author->save();

        return redirect('backend/bn-authors')->with('successMsg', 'The author has been inserted successfully!');
    }

    public function edit($id)
    {
        $author = BnAuthor::find($id);

        return view('backend.settings.bn.author.bn_author_edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'author_name'       => 'required',
            'author_slug'       => ['required', Rule::unique('authors')->ignore($id, 'author_id')],
            'author_name_bn'    => 'required',
            'author_initial'    => 'required|string|max:30|unique:authors,author_initial,'.$id.',author_id',
            'author_initial_bn' => 'required|unique:authors,author_initial_bn,'.$id.',author_id',
            'author_image'      => 'mimes:jpg,jpeg,png|max:2048'
        ]);

        $author = BnAuthor::find($id);
        $author->author_type        = $request->author_type;
        $author->author_name        = $request->author_name;
        $author->author_name_bn     = $request->author_name_bn;
        $author->author_slug        = fFormatUrl($request->author_slug);
        $author->author_initial     = $request->author_initial;
        $author->author_initial_bn  = $request->author_initial_bn;
        $author->author_bio         = $request->author_bio;
        $author->author_bio_bn      = $request->author_bio_bn;

        if($request->hasFile('author_image')){
            FileController::deleteFile(config('appconfig.authorImagePath'), $author->img_path);
            $ext = $request->file('author_image')->getClientOriginalExtension();
            $filename = $author->author_slug . '-' . date("YmdHis") .'.'. $ext;
            $request->file('author_image')->move(config('appconfig.authorImagePath'), $filename);
            $author->img_path = $filename;
        }

        $author->save();

        return redirect('backend/bn-authors')->with('successMsg', 'The author has been updated successfully!');
    }

    public function destroy($id)
    {
        BnAuthor::where('author_id', $id)->update(['deletable' => 2]);

        return redirect('backend/bn-authors')->with('successMsg', 'The author has been removed successfully!');
    }
}

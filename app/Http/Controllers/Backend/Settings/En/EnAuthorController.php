<?php

namespace App\Http\Controllers\Backend\Settings\En;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MonthlyFolderController;
use App\Models\EnAuthor;
use Illuminate\Http\Request;

class EnAuthorController extends Controller
{
    public function __construct(){
        $this->sMonthlyImageFolder=MonthlyFolderController::getLastMonthlyFolder().'/';
    }

    public function index(Request $request)
    {
        // Get search field values for pagination
        $exPartPagination = ["author_type" => $request->author_type, "keyword" => $request->keyword];

        $authors = EnAuthor::where('deletable', 1);

        // Search author with TYPE
//        if ($request->has('author_type') && $request->author_type != null && $request->author_type != 'all') {
//            $authors = $authors->where('author_type', $request->author_type);
//        }

        if ($request->has('keyword') && $request->keyword != null){ // Search author name or initial
            $authors = $authors->where('author_name', 'like', '%'.trim($request->keyword).'%')
                               ->orWhere('author_initial', 'like', '%'.trim($request->keyword).'%');
        }

        $authors = $authors->latest()->paginate(10);

        return view('backend.settings.en.author.en_author_list', compact('authors', 'exPartPagination'));
    }

    public function create()
    {
        return view('backend.settings.en.author.en_author_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'author_name'       => 'required',
            'author_slug'       => 'required|unique:mysqlen.authors',
            'author_initial'    => 'required|unique:mysqlen.authors',
            'author_image'      => 'mimes:jpg,jpeg,png|max:100'
        ]);

        $author = new EnAuthor();
        $author->author_type        = $request->author_type;
        $author->author_name        = $request->author_name;
        $author->author_slug        = fFormatUrl($request->author_slug);
        $author->author_initial     = $request->author_initial;
        $author->author_bio         = $request->author_bio;

        if($request->hasFile('author_image')){
            $ext = $request->file('author_image')->getClientOriginalExtension();
            $filename = $author->author_slug . '-' . date("YmdHis") .'.'. $ext;
            $request->file('author_image')->move(config('appconfig.authorImagePath'), $filename);
            $author->img_path = $filename;
        }

        $author->save();

        return redirect('backend/en-authors')->with('successMsg', 'The author has been inserted successfully!');
    }

    public function edit($id)
    {
        $author = EnAuthor::find($id);

        return view('backend.settings.en.author.en_author_edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'author_name'       => 'required',
            'author_slug'       => 'required',
            'author_initial'    => 'required',
            'author_image'      => 'mimes:jpg,jpeg,png|max:100'
        ]);

        $author = EnAuthor::find($id);
        $author->author_type        = $request->author_type;
        $author->author_name        = $request->author_name;
        $author->author_slug        = fFormatUrl($request->author_slug);
        $author->author_initial     = $request->author_initial;
        $author->author_bio         = $request->author_bio;

        if($request->hasFile('author_image')){
            FileController::deleteFile(config('appconfig.authorImagePath'), $author->img_path);
            $ext = $request->file('author_image')->getClientOriginalExtension();
            $filename = $author->author_slug . '-' . date("YmdHis") .'.'. $ext;
            $request->file('author_image')->move(config('appconfig.authorImagePath'), $filename);
            $author->img_path = $filename;
        }

        $author->save();

        return redirect('backend/en-authors')->with('successMsg', 'The author has been updated successfully!');
    }

    public function destroy($id)
    {
        EnAuthor::where('author_id', $id)->update(['deletable' => 2]);

        return redirect('backend/en-authors')->with('successMsg', 'The author has been removed successfully!');
    }
}

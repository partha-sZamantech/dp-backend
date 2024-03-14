<?php

namespace App\Http\Controllers\Backend\Magazine;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Magazine;
use App\Models\MagazinePage;
use App\Models\User;
use Illuminate\Http\Request;

class MagazinePageController extends Controller
{
    public function index($magazineId)
    {
        $pages = MagazinePage::query()
            ->addSelect([
                'magazine_name' => Magazine::select('name')
                ->whereColumn('magazines.id', 'magazine_id')
                ->take(1)
            ])->addSelect([
                'uploader' => User::select('name')
                ->whereColumn('users.id', 'user_id')
                ->take(1)
            ])
            ->where('magazine_id', $magazineId)
            ->where('deletable', 1)
            ->orderByDesc('id')
            ->paginate(20);

        return view('backend.magazine.pages-list', compact('pages'));
    }

    public function create($magazineId)
    {
        $magazine = Magazine::find($magazineId);
        return view('backend.magazine.page-create', compact('magazine'));
    }

    public function store(Request $request, $magazineId)
    {
        $this->validate($request, [
            'page'      => 'required|image|mimes:jpg',
        ]);

        $extPage = MagazinePage::query()->where('magazine_id', $magazineId)->orderByDesc('id')->first();
        $counter = $extPage && $extPage->counter ? $extPage->counter+1 : 1;

        $page = new MagazinePage();

        $page->magazine_id  = $magazineId;
        $imgPath = 'magazine-'.$magazineId.'/';

        if ($request->page) {
            if ($request->hasFile('page')) { // upload SM normal image
                $imagePath = FileController::magazinePageUpload($request->page, $imgPath, $counter, 500,650);

                // Thumb Image upload
                $thumbPath = FileController::magazinePageUpload($request->page, $imgPath, $counter.'-thumb', 76, 100);

                // Large Image upload
                $largePath = FileController::magazinePageUpload($request->page, $imgPath, $counter.'-large',1115, 1443);
            }

            $page->img_path = $imagePath;
            $page->img_thumb_path = $thumbPath;
            $page->img_large_path = $largePath;
        }
        $page->counter = $counter;
        $page->user_id = auth()->id();
        $page->save();

        // Clear the cache
        return redirect(route('magazine-pages.index', $magazineId))->with('successMsg', 'The magazine page has been added successfully!');
    }

    public function edit($magazineId, $id)
    {
        $page = MagazinePage::findOrFail($id);
        $magazine = Magazine::find($magazineId);
        return view('backend.magazine.page-edit',compact('page', 'magazine'));
    }

    public function update(Request $request, $magazineId, $id)
    {
        $this->validate($request, [
            'page' => 'nullable|image|mimes:jpg',
        ]);

        $page = MagazinePage::find($id);

        $imgPath = 'magazine-'.$magazineId.'/';

        if ($request->page) {
            if ($request->hasFile('page')) { // upload SM normal image
                if (FileController::deleteFile(config('appconfig.magazineImagePath'), $page->img_thumb_path)
                    && FileController::deleteFile(config('appconfig.magazineImagePath'), $page->img_path)
                    && FileController::deleteFile(config('appconfig.magazineImagePath'), $page->img_large_path))
                {
                    $imagePath = FileController::magazinePageUpload($request->page, $imgPath, $page->counter, 500, 650);

                    // Thumb Image upload
                    $thumbPath = FileController::magazinePageUpload($request->page, $imgPath, $page->counter.'-thumb', 76, 100);

                    // Large Image upload
                    $largePath = FileController::magazinePageUpload($request->page, $imgPath, $page->counter.'-large', 1115, 1443);
                }
            }

            $page->img_path = $imagePath;
            $page->img_thumb_path = $thumbPath;
            $page->img_large_path = $largePath;
        }
        $page->save();

        // Clear the cache
        return redirect(route('magazine-pages.index', $magazineId))->with('successMsg', 'The magazine page has been updated successfully!');
    }

    public function destroy($magazineId, $id)
    {
        MagazinePage::where('id', $id)->update(['deletable' => 2]);

        return redirect(route('magazine-pages.index', $magazineId))->with('successMsg', 'The magazine has been removed successfully!');
    }
}

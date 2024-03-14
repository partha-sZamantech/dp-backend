<?php

namespace App\Http\Controllers\Backend\Epaper;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Epaper;
use App\Models\EpaperPage;
use App\Models\User;
use Illuminate\Http\Request;

class EpaperPageController extends Controller
{
    public function index($epaperId)
    {
        $pages = EpaperPage::query()
            ->addSelect([
                'date' => Epaper::select('paper_date')
                ->whereColumn('epapers.id', 'epaper_id')
                ->take(1)
            ])->addSelect([
                'uploader' => User::select('name')
                ->whereColumn('users.id', 'user_id')
                ->take(1)
            ])
            ->where('epaper_id', $epaperId)
            ->where('deletable', 1)
            ->paginate(20);

        return view('backend.epaper.pages-list', compact('pages'));
    }

    public function create($epaperId)
    {
        $paper = Epaper::find($epaperId);
        return view('backend.epaper.page-create', compact('paper'));
    }

    public function store(Request $request, $epaperId)
    {
        $this->validate($request, [
            'page'      => 'required|image|mimes:jpg',
        ]);

        $extPage = EpaperPage::query()->where('epaper_id', $epaperId)->orderByDesc('id')->first();
        $page_no = $extPage && $extPage->page_no ? $extPage->page_no+1 : 1;

        $page = new EpaperPage();

        $page->epaper_id  = $epaperId;
        $imgPath = 'epaper-'.$epaperId.'/';

        if ($request->page) {
            if ($request->hasFile('page')) { // upload SM normal image
                $imagePath = FileController::epaperPageUpload($request->page, $imgPath, $page_no, 500,650);

                // Thumb Image upload
                $thumbPath = FileController::epaperPageUpload($request->page, $imgPath, $page_no.'-thumb', 76, 100);

                // Large Image upload
                $largePath = FileController::epaperPageUpload($request->page, $imgPath, $page_no.'-large',1700, 2550);
            }

            $page->img_path = $imagePath;
            $page->img_thumb_path = $thumbPath;
            $page->img_large_path = $largePath;
        }
        $page->page_no = $page_no;
        $page->user_id = auth()->id();
        $page->save();

        // Clear the cache
        return redirect(route('epaper-pages.index', $epaperId))->with('successMsg', 'The epaper page has been added successfully!');
    }

    public function edit($epaperId, $id)
    {
        $page = EpaperPage::findOrFail($id);
        $epaper = Epaper::find($epaperId);
        return view('backend.epaper.page-edit',compact('page', 'epaper'));
    }

    public function update(Request $request, $epaperId, $id)
    {
        $this->validate($request, [
            'page' => 'nullable|image|mimes:jpg',
        ]);

        $page = EpaperPage::find($id);

        $imgPath = 'epaper-'.$epaperId.'/';

        if ($request->page) {
            if ($request->hasFile('page')) { // upload SM normal image
                if (FileController::deleteFile(config('appconfig.epaperImagePath'), $page->img_thumb_path)
                    && FileController::deleteFile(config('appconfig.epaperImagePath'), $page->img_path)
                    && FileController::deleteFile(config('appconfig.epaperImagePath'), $page->img_large_path))
                {
                    $imagePath = FileController::epaperPageUpload($request->page, $imgPath, $page->page_no, 500, 650);

                    // Thumb Image upload
                    $thumbPath = FileController::epaperPageUpload($request->page, $imgPath, $page->page_no . '-thumb', 76, 100);

                    // Large Image upload
                    $largePath = FileController::epaperPageUpload($request->page, $imgPath, $page->page_no . '-large', 1700, 2550);
                }
            }

            $page->img_path = $imagePath;
            $page->img_thumb_path = $thumbPath;
            $page->img_large_path = $largePath;
        }
        $page->save();

        // Clear the cache
        return redirect(route('epaper-pages.index', $epaperId))->with('successMsg', 'The epaper page has been updated successfully!');
    }

    public function destroy($epaperId, $id)
    {
        EpaperPage::where('id', $id)->update(['deletable' => 2]);

        return redirect(route('epaper-pages.index', $epaperId))->with('successMsg', 'The epaper has been removed successfully!');
    }
}

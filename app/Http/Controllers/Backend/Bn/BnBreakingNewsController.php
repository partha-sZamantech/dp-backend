<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Http\Services\Bn\BnBreakingNewsService;
use App\Models\BnBreakingNews;
use App\Models\BnSiteSettings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BnBreakingNewsController extends Controller
{
    public function index()
    {
        $breakingNews = BnBreakingNews::query()
            ->addSelect([
                'created_by' => User::select('name')
                    ->whereColumn('users.id', 'user_id')
                    ->take(1)
            ])
            ->latest()
            ->paginate(20);

        return view('backend.bn.breaking_news.list', compact('breakingNews'));
    }

    public function settingPosition()
    {
        $breakingNews = BnBreakingNews::select(['id', 'news_title'])->orderBy('position')->get();
        return view('backend.bn.breaking_news.setting_position', compact('breakingNews'));
    }

    public function saveSettingPosition()
    {

        // Update the breaking positions
        $data = [];
        parse_str(request()->data, $data);

        foreach ($data['item'] as $key => $id) {
            BnBreakingNews::where('id', $id)->update(['position' => ++$key]);
        }

        (new BnBreakingNewsService())->clearCache();

        return 'ok';
    }

    public function create()
    {
        return view('backend.bn.breaking_news.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'news_title'    => 'required',
            'news_link'     => 'nullable|url',
            'expires'       => 'required|numeric'
        ]);

        $breakingNews = new BnBreakingNews();

        $breakingNews->news_title   = $request->news_title;
        $breakingNews->news_link    = $request->news_link;
        $breakingNews->hours        = $request->expires;
        $breakingNews->expired_time = Carbon::now()->addHours($request->expires)->format('Y-m-d H:i:s');
        $breakingNews->user_id      = auth()->id();
        $breakingNews->save();

        // Clear the cache
        (new BnBreakingNewsService())->clearCache();

        return redirect('backend/bn-breaking-news')->with('successMsg', 'The news has been added successfully!');
    }

    public function edit($id)
    {
        $news = BnBreakingNews::find($id);
        return view('backend.bn.breaking_news.edit',compact('news'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'news_title'    => 'required',
            'news_link'     => 'nullable|url',
            'expires'       => 'required|numeric',
        ]);

        $breakingNews = BnBreakingNews::find($id);

        $breakingNews->news_title   = $request->news_title;
        $breakingNews->news_link    = $request->news_link;
        $breakingNews->hours        = $request->expires;
        $breakingNews->expired_time = Carbon::now()->addHours($request->expires)->format('Y-m-d H:i:s');
        $breakingNews->user_id      = auth()->id();
        $breakingNews->save();

        // Clear the cache
        (new BnBreakingNewsService())->clearCache();

        return redirect('backend/bn-breaking-news')->with('successMsg', 'The news has been updated successfully!');
    }

    public function destroy($id)
    {
        BnBreakingNews::destroy($id);
        // Clear the cache
        (new BnBreakingNewsService())->clearCache();
        return redirect('backend/bn-breaking-news')->with('successMsg', 'The news has been removed successfully!');
    }
}

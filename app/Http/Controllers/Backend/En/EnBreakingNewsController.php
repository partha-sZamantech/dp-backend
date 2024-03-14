<?php

namespace App\Http\Controllers\Backend\En;

use App\Http\Controllers\Controller;
use App\Http\Services\En\EnBreakingNewsService;
use App\Models\EnBreakingNews;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EnBreakingNewsController extends Controller
{
    public function index()
    {
        $breakingNews = EnBreakingNews::query()
            ->addSelect([
                'created_by' => User::select('name')
                    ->whereColumn('users.id', 'user_id')
                    ->toBase()
                    ->take(1)
            ])
            ->latest()
            ->paginate(20);

        return view('backend.en.breaking_news.list', compact('breakingNews'));
    }

    public function settingPosition()
    {
        $breakingNews = EnBreakingNews::select(['id', 'news_title'])->orderBy('position')->get();
        return view('backend.en.breaking_news.setting_position', compact('breakingNews'));
    }

    public function saveSettingPosition()
    {

        // Update the breaking positions
        $data = [];
        parse_str(request()->data, $data);

        foreach ($data['item'] as $key => $id) {
            EnBreakingNews::where('id', $id)->update(['position' => ++$key]);
        }

        (new EnBreakingNewsService())->clearCache();

        return 'ok';
    }

    public function create()
    {
        return view('backend.en.breaking_news.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'news_title'    => 'required',
            'news_link'     => 'nullable|url',
            'expires'       => 'required|numeric'
        ]);

        $breakingNews = new EnBreakingNews();

        $breakingNews->news_title   = $request->news_title;
        $breakingNews->news_link    = $request->news_link;
        $breakingNews->hours        = $request->expires;
        $breakingNews->expired_time = Carbon::now()->addHours($request->expires)->format('Y-m-d H:i:s');
        $breakingNews->user_id      = auth()->id();
        $breakingNews->save();

        // Clear the cache
        (new EnBreakingNewsService())->clearCache();

        return redirect('backend/en-breaking-news')->with('successMsg', 'The news has been added successfully!');
    }

    public function edit($id)
    {
        $news = EnBreakingNews::find($id);
        return view('backend.en.breaking_news.edit',compact('news'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'news_title'    => 'required',
            'news_link'     => 'nullable|url',
            'expires'       => 'required|numeric',
        ]);

        $breakingNews = EnBreakingNews::find($id);

        $breakingNews->news_title   = $request->news_title;
        $breakingNews->news_link    = $request->news_link;
        $breakingNews->hours        = $request->expires;
        $breakingNews->expired_time = Carbon::now()->addHours($request->expires)->format('Y-m-d H:i:s');
        $breakingNews->user_id      = auth()->id();
        $breakingNews->save();

        // Clear the cache
        (new EnBreakingNewsService())->clearCache();

        return redirect('backend/en-breaking-news')->with('successMsg', 'The news has been updated successfully!');
    }

    public function destroy($id)
    {
        EnBreakingNews::destroy($id);
        // Clear the cache
        (new EnBreakingNewsService())->clearCache();
        return redirect('backend/en-breaking-news')->with('successMsg', 'The news has been removed successfully!');
    }
}

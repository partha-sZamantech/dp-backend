<?php


namespace App\Http\Services\En;

use App\Models\EnContent;
use App\Models\EnContentPosition;
use Illuminate\Support\Facades\Cache;

class EnContentService
{
    public function getPositionContent($positionId=null, $catId=null, $cacheKey=null)
    {
        $contents = [];
        //if (!Cache::has($cacheKey)) {
            $position = EnContentPosition::query()
                ->select(['position_id', 'position_name', 'cat_id', 'special_cat_id', 'subcat_id', 'content_ids', 'total_content'])
                ->when($positionId, function($query) use ($positionId){
                    return $query->where('position_id', $positionId);
                })
                ->when($catId, function ($query) use ($catId){
                    return $query->where('cat_id', $catId);
                })
                ->where('deletable', 1)
                ->first();

            if ($position && $position->content_ids) {
                $aContentIDs = explode(",", $position->content_ids);
                $aContentIDs = array_slice($aContentIDs, 0, $position->total_content);
                $sContentIDs = implode(',', $aContentIDs);
                $contents = EnContent::with('category', 'subcategory')->whereIn('content_id', $aContentIDs)->where('status', 1)->where('deletable', 1)->orderByRaw("FIELD(content_id, $sContentIDs)")->get();
                //Cache::forever($cacheKey, $contents);
            }
        /*} else {
            $contents = Cache::get($cacheKey);
        }*/

        return $contents;
    }
}

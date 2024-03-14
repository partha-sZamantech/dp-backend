<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Models\BnBreakingNews;
use App\Models\BnContent;
use App\Models\BnContentPosition;
use App\Models\BnSubcategory;
use App\Models\BnVideo;
use App\Models\District;
use App\Models\Upozilla;
use Illuminate\Http\Request;

class BnHelperController extends Controller
{
    public static function getCategoryContent($catId, $limit, $paginate=false){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', $catId)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');

        if($paginate){
            $contents = $contents->paginate($limit);
        }else{
            $contents = $contents->take($limit)->get();
        }

        return $contents;
    }

    public static function getTagContent($tagSlug, $limit, $paginate=false){
        $contents = BnContent::with('category', 'subcategory')->whereRaw("FIND_IN_SET('$tagSlug', tags)")->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');

        if($paginate){
            $contents = $contents->paginate($limit);
        }else{
            $contents = $contents->take($limit)->get();
        }

        return $contents;
    }

    public static function getAuthorContent($authorSlug, $limit, $paginate=false){
        $contents = BnContent::with('category', 'subcategory')->whereRaw("FIND_IN_SET('$authorSlug', author_slugs)")->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');

        if($paginate){
            $contents = $contents->paginate($limit);
        }else{
            $contents = $contents->take($limit)->get();
        }

        return $contents;
    }

    public static function getSubcatContent($subcatSlug, $limit=5, $paginate=false){
        $subcat = BnSubcategory::where('subcat_slug', $subcatSlug)->where('deletable', 1)->first();
        $subcatId = $subcat->subcat_id;
        $contents = BnContent::with('category', 'subcategory')->where('subcat_id', $subcatId)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');

        if($paginate){
            $contents = $contents->paginate($limit);
        }else{
            $contents = $contents->take($limit)->get();
        }

        return $contents;
    }

    public static function getLatestContent($limit=5, $paginate=false){
        $contents = BnContent::with('category', 'subcategory')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');


        if($paginate){
            $contents = $contents->paginate($limit);
        }else{
            $contents = $contents->take($limit)->get();
        }
        return $contents;
    }

    public static function getPopularContent($limit=5){
        $contents = BnContent::with('category', 'subcategory')
            ->where('status', 1)
            ->where('deletable', 1)
            ->where('created_at', '>', now()->subDays(3)->endOfDay())
            ->orderBy('total_hit', 'desc')
            ->take($limit)
            ->get();
        return $contents;
    }

    public static function getLatestCatContent($catId, $limit=5, $skip=null){
        $contents = BnContent::with('category', 'subcategory')->where('cat_id', $catId)->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');
        if ($skip){
            $contents = $contents->skip($skip);
        }

        $contents = $contents->take($limit)->get();
        return $contents;
    }

    public function districtPopulate(Request $request){
        $districts = District::where('division_id', $request->division_id)->where('deletable', 1)->get();
        return $districts;
    }

    public function upozillaPopulate(Request $request){
        $upozillas = Upozilla::where('district_id', $request->district_id)->where('deletable', 1)->get();
        return $upozillas;
    }

    public static function getLatestCatVideo($catId, $limit=5, $skip=null) {
        $contents = BnVideo::query()
                       ->with('category:id,slug,name_bn')
                       ->select(['id', 'cat_id', 'type', 'title', 'img_bg_path', 'img_sm_path', 'code', 'target'])
                       ->where('cat_id', $catId)->where('status', 1)->where('deletable', 1);

        if ($skip){
            $contents = $contents->skip($skip);
        }

        $contents = $contents->take($limit)->latest()->get();
        return $contents;
    }

}

<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Services\AdManagementService;
use App\Models\BnAd;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BnAdManagementController extends Controller
{
    public function index()
    {
        $ads = BnAd::where('deletable', 1)->orderBy('page')->orderBy('position')->get();
        return view('backend.settings.bn.ads.list', compact('ads'));
    }

    public function create()
    {
        return view('backend.settings.bn.ads.create');
    }

    public function store(Request $request)
    {
        $ad = new BnAd();
        $ad->type = $request->ad_type;
        $ad->page = $request->ad_page;
        $ad->position = $request->ad_position;
        $ad->dfp_header_code = $request->header_code;
        $ad->code = $request->code;
        $ad->external_link = $request->external_link;
        $ad->start_time = $request->start_time;
        $ad->end_time = $request->end_time;
        $ad->status = $request->status;

        if ($request->hasFile('desktop_image_path')) {
            $this->validate($request, [
                'desktop_image_path' => 'mimes:jpg,jpeg,png,gif'
            ]);
            $ad->desktop_image_path = FileController::fileUpload($request->desktop_image_path, config('appconfig.adPath'));
        }

        if ($request->hasFile('mobile_image_path')) {
            $this->validate($request, [
                'mobile_image_path'      => 'mimes:jpg,jpeg,png,gif'
            ]);
            $ad->mobile_image_path = FileController::fileUpload($request->mobile_image_path, config('appconfig.adPath'));
        }

        $ad->save();

        // Clear Cache
        (new AdManagementService())->clearAdsCache($ad);

        return redirect('backend/bn-ads')->with('successMsg', 'The ad created successfully!');
    }

    public function edit($id)
    {
        $ad = BnAd::find($id);
        return view('backend.settings.bn.ads.edit', compact('ad'));
    }

    public function update(Request $request, $id)
    {
        $ad = BnAd::find($id);
        $ad->type = $request->ad_type;
//        $ad->position = $request->ad_position;
        $ad->dfp_header_code = $request->header_code;
        $ad->code = $request->code;
        $ad->external_link = $request->external_link;
        $ad->start_time = $request->start_time;
        $ad->end_time = $request->end_time;
        $ad->status = $request->status;

        if ($request->hasFile('desktop_image_path')) {
            $this->validate($request, [
                'desktop_image_path' => 'mimes:jpg,jpeg,png,gif'
            ]);
            $ad->desktop_image_path = FileController::fileUpload($request->desktop_image_path, config('appconfig.adPath'));
        }

        if ($request->hasFile('mobile_image_path')) {
            $this->validate($request, [
                'mobile_image_path'      => 'mimes:jpg,jpeg,png,gif'
            ]);
            $ad->mobile_image_path = FileController::fileUpload($request->mobile_image_path, config('appconfig.adPath'));
        }

        $ad->save();

        // Clear Cache
        (new AdManagementService())->clearAdsCache($ad);

        return redirect('backend/bn-ads')->with('successMsg', 'The ad updated successfully!');
    }

    public function destroy($id)
    {
        BnAd::where('id', $id)->update(['deletable' => 2]);

        return redirect('backend/bn-ads')->with('successMsg', 'The ad removed successfully!');
    }
}

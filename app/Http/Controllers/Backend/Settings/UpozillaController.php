<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Upozilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class UpozillaController extends Controller
{
    public function index()
    {
        $upozillas = Upozilla::with('district')->where('deletable', 1)->where('upozilla_id', '<>', 1)->paginate(20);

        return view('backend.settings.upozilla.upozilla_list', compact('upozillas'));
    }

    public function create()
    {
        $districts = District::where('deletable', 1)->orderBy('district_name')->get();
        return view('backend.settings.upozilla.upozilla_create', compact('districts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['district' => 'required', 'upozilla_name' => 'required']);
        $district = explode('|', $request->district);

        $upozilla = new Upozilla();
        $upozilla->district_id = $district[0];
        $upozilla->division_id = $district[1];
        $upozilla->upozilla_name = $request->upozilla_name;
        $upozilla->upozilla_name_bn = $request->upozilla_name_bangla;
        $upozilla->upozilla_slug = fFormatURL($request->upozilla_name);
        $upozilla->save();

        return redirect('backend/upozillas/create')->with('successMsg', 'Upozilla has been added successfully!');
    }

    public function edit($id)
    {
        $districts = District::where('deletable', 1)->orderBy('district_name')->get();
        $upozilla = Upozilla::find($id);
        return view('backend.settings.upozilla.upozilla_edit', compact('upozilla', 'districts'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'district' => 'required',
            'upozilla_name' => 'required'
        ]);

        $district = explode('|', $request->district);

        $upozilla = Upozilla::find($id);
        $upozilla->district_id = $district[0];
        $upozilla->division_id = $district[1];
        $upozilla->upozilla_name = $request->upozilla_name;
        $upozilla->upozilla_name_bn = $request->upozilla_name_bangla;
        $upozilla->upozilla_slug = fFormatURL($request->upozilla_name);
        $upozilla->save();
        return redirect('backend/upozillas')->with('successMsg', 'Upozilla has been updated successfully!');
    }

    public function destroy($id)
    {
        Upozilla::where('upozilla_id', $id)->update(['deletable' => 2]);
        return redirect('backend/upozillas')->with('successMsg', 'Upozilla has been deleted successfully!');
    }

    public function upozillaPopulate(Request $request)
    {
        $district_id = $request->district_id;
        $upozillaCacheKey = 'upozillasByDistrictIdCacheKey-' . $district_id;
        if (Cache::has($upozillaCacheKey)){
            $upozillas = Cache::get($upozillaCacheKey);
        }else{
            $upozillas = Upozilla::where('district_id', $district_id)->get();
            Cache::forever($upozillaCacheKey, $upozillas);
        }
        return Response::json($upozillas);
    }

}

<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::with('division')->where('deletable', 1)->get();
        return view('backend.settings.district.district_list', compact('districts'));
    }

    public function create()
    {
        $divisions = Division::where('deletable', 1)->get();
        return view('backend.settings.district.district_create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['district_name' => 'required|unique:districts']);

        $district = new District();
        $district->division_id      = $request->division;
        $district->district_name    = $request->district_name;
        $district->district_name_bn = $request->district_name_bn;
        $district->district_slug    = fFormatUrl($request->district_name);
        $district->save();

        return redirect('backend/districts')->with('successMsg', 'The district has been added successfully!');
    }

    public function edit($id)
    {
        $divisions = Division::where('deletable', 1)->get();
        $district = District::find($id);
        return view('backend.settings.district.district_edit', compact('district', 'divisions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['district_name' => 'required']);

        $district = District::find($id);
        $district->division_id      = $request->division;
        $district->district_name    = $request->district_name;
        $district->district_name_bn = $request->district_name_bn;
        $district->district_slug    = fFormatUrl($request->district_name);
        $district->save();

        return redirect('backend/districts')->with('successMsg', 'The district has been updated successfully!');
    }

    public function destroy($id)
    {
        District::where('district_id', $id)->update(['deletable' => 2]);
        return redirect('backend/districts')->with('successMsg', 'The district has been removed successfully!');
    }
}

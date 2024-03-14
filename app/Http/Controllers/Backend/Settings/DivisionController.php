<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::where('deletable', 1)->get();
        return view('backend.settings.division.division_list', compact('divisions'));
    }

    public function create()
    {
        return view('backend.settings.division.division_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['division_name' => 'required|unique:divisions']);

        $division = new Division();
        $division->division_name    = $request->division_name;
        $division->division_name_bn = $request->division_name_bn;
        $division->division_slug    = fFormatUrl($request->division_name);
        $division->save();

        return redirect('backend/divisions')->with('successMsg', 'The division has been added successfully!');
    }

    public function edit($id)
    {
        $division = Division::find($id);
        return view('backend.settings.division.division_edit', compact('division'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['division_name' => 'required']);

        $division = Division::find($id);
        $division->division_name    = $request->division_name;
        $division->division_name_bn = $request->division_name_bn;
        $division->division_slug    = fFormatUrl($request->division_name);
        $division->save();

        return redirect('backend/divisions')->with('successMsg', 'The division has been updated successfully!');
    }

    public function destroy($id)
    {
        Division::where('division_id', $id)->update(['deletable' => 2]);
        return redirect('backend/divisions')->with('successMsg', 'The division has been removed successfully!');
    }
}

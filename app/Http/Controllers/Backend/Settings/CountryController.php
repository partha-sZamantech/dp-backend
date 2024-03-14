<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::where('deletable', 1)->get();
        return view('backend.settings.country.country_list', compact('countries'));
    }

    public function create()
    {
        return view('backend.settings.country.country_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['country_name' => 'required|unique:countries']);

        $country = new Country();
        $country->country_name      = $request->country_name;
        $country->country_name_bn   = $request->country_name_bn;
        $country->country_slug      = fFormatUrl($request->country_name);
        $country->save();

        return redirect('backend/countries')->with('successMsg', 'The country has been added successfully!');
    }

    public function edit($id)
    {
        $country = Country::find($id);
        return view('backend.settings.country.country_edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['country_name' => 'required']);

        $country = Country::find($id);
        $country->country_name      = $request->country_name;
        $country->country_name_bn   = $request->country_name_bn;
        $country->country_slug      = fFormatUrl($request->country_name);
        $country->save();

        return redirect('backend/countries')->with('successMsg', 'The country has been updated successfully!');
    }

    public function destroy($id)
    {
        Country::where('country_id', $id)->update(['deletable' => 2]);
        return redirect('backend/countries')->with('successMsg', 'The country has been removed successfully!');
    }
}

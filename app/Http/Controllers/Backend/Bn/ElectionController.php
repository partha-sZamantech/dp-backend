<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Services\Bn\ElectionService;
use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::query()->select(['id', 'title', 'total_center', 'party_one_name', 'party_two_name','party_three_name','party_four_name', 'status'])->get();

        return view('backend.bn.election.list', compact('elections'));
    }

    public function create()
    {
        return view('backend.bn.election.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'total_center'  => 'nullable|numeric',
            'casted_center'  => 'nullable|numeric',
            'party_one_votes'  => 'nullable|numeric',
            'party_two_votes'  => 'nullable|numeric',
            'party_three_votes'  => 'nullable|numeric',
            'party_four_votes'  => 'nullable|numeric',
        ]);

        $election = new Election();

        $election->title            = $request->title;
        $election->total_center     = $request->total_center;
        $election->casted_center    = $request->casted_center;
        $election->party_one_name   = $request->party_one_name;
        $election->party_two_name   = $request->party_two_name;
        $election->party_three_name = $request->party_three_name;
        $election->party_four_name  = $request->party_four_name;
        $election->party_one_votes  = $request->party_one_votes;
        $election->party_two_votes  = $request->party_two_votes;
        $election->party_three_votes= $request->party_three_votes;
        $election->party_four_votes =$request->party_four_votes;
        $election->status           = $request->status;
        $election->save();

        // Clear the cache
        (new ElectionService())->clearCache();

        return redirect('backend/elections')->with('successMsg', 'The election has been added successfully!');
    }

    public function edit($id)
    {
        $election = Election::find($id);
        return view('backend.bn.election.edit',compact('election'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'total_center'  => 'nullable|numeric',
            'casted_center'  => 'nullable|numeric',
            'party_one_votes'  => 'nullable|numeric',
            'party_two_votes'  => 'nullable|numeric',
            'party_three_votes'  => 'nullable|numeric',
            'party_four_votes'  => 'nullable|numeric',
        ]);

        $election = Election::find($id);

        $election->title            = $request->title;
        $election->total_center     = $request->total_center;
        $election->casted_center    = $request->casted_center;
        $election->party_one_name   = $request->party_one_name;
        $election->party_two_name   = $request->party_two_name;
        $election->party_three_name = $request->party_three_name;
        $election->party_four_name  = $request->party_four_name;
        $election->party_one_votes  = $request->party_one_votes;
        $election->party_two_votes  = $request->party_two_votes;
        $election->party_three_votes= $request->party_three_votes;
        $election->party_four_votes =$request->party_four_votes;
        $election->status           = $request->status;
        $election->save();

        // Clear the cache
        (new ElectionService())->clearCache($id);

        return redirect('backend/elections')->with('successMsg', 'The election has been updated successfully!');
    }

    public function destroy($id)
    {
        Election::where('id', $id)->update(['deletable' => 2]);
        // Clear the cache
        (new ElectionService())->clearCache();
        return redirect('backend/elections')->with('successMsg', 'The election has been removed successfully!');
    }
}

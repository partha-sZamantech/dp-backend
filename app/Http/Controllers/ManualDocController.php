<?php

namespace App\Http\Controllers;

use App\Models\ManualDocument;
use Illuminate\Http\Request;

class ManualDocController extends Controller
{
    public function __construct(){
        $this->sMonthlyImageFolder=MonthlyFolderController::getLastMonthlyFolder().'/';
    }

    public function index()
    {
        $docs = ManualDocument::where('deletable', 1)->orderBy('doc_id', 'desc')->get();

        return view('backend.manualdoc.manual_doc_list', compact('docs'));
    }

    public function create()
    {
        return view('backend.manualdoc.manual_doc_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['manualDocument' => 'required|mimes:pdf,jpg,jpeg,png,gif']);

        $manualdoc = new ManualDocument();

        if($request->hasFile('manualDocument')){
            $finalDocPath = FileController::fileUpload($request->manualDocument, config('appconfig.contentDocumentPath'));

            $manualdoc->doc_path = $finalDocPath;
        }

        $manualdoc->save();

        return redirect('backend/manual-docs')->with('successMsg', 'The document has been uploaded successfully!');
    }

    public function edit($id)
    {
        $doc = ManualDocument::find($id);

        return view('backend.manualdoc.manual_doc_edit', compact('doc'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['manualDocument' => 'required|mimes:pdf,jpg,jpeg,png,gif']);

        $manualdoc = ManualDocument::find($id);

        if($request->hasFile('manualDocument')){
            $finalDocPath = FileController::fileUpload($request->manualDocument, config('appconfig.contentDocumentPath'));

            $manualdoc->doc_path = $finalDocPath;
        }

        $manualdoc->save();

        return redirect('backend/manual-docs')->with('successMsg', 'The document has been updated successfully!');
    }

    public function destroy($id)
    {
        ManualDocument::where('doc_id', $id)->update(['deletable' => 2]);

        return redirect('backend/manual-docs')->with('successMsg', 'The document has been removed successfully!');
    }
}

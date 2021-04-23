<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use DB;
use Auth;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentsDatas = DB::table('documents')
            ->join('users', 'documents.user_id', '=', 'users.id')

            ->select(
            'documents.id',
            'documents.name',
            'documents.file_path',
            'documents.created_at')
            ->latest()
            ->get();

        return view('termsandconditions.documentstermsandconditions')
        ->with('documentsDatas', $documentsDatas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('termsandconditions.uploaddocuments');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'pdfFiles' => 'required|max:2048',
            'pdfFiles.*' => 'mimes:jpg,jpeg,png,gif,doc,pdf,docx,zip'
          ]);

                foreach ($req->pdfFiles as $pdffile) {
                    $name = $pdffile->getClientOriginalName();
                    $filename = $pdffile->store('DocumentsFolder', 'public');
                    $auth = Auth::user()->id;
                    Document::create([
                        'name' => $name,
                        'file_path' => $filename,
                        'user_id' => $auth
                    ]);
                }
              return back()->with("message", "Documents has been uploaded successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

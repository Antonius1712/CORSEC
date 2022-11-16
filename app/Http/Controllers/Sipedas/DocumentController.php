<?php

namespace App\Http\Controllers\Sipedas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Document;
use App\Model\MasterDocument;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $status;
    protected $docType;
    protected $docName;
    protected $docDesc;

    public function __construct()
    {
        $this->status = [
            1 => 'Active',
            0 => 'Inactive'
        ];

        $this->docType = MasterDocument::pluck('document_type', 'id')->unique();
        $this->docName = Document::orderby('id','desc')->get()->pluck('document_name', 'id')->unique();
        $this->docDesc = Document::orderby('id','desc')->get()->pluck('document_description', 'id')->unique();
    }

    public function index()
    {
        $Document = Document::where('status', 1)->get();
        $docName = $this->docName;
        $docDesc = $this->docDesc;
        $docType = $this->docType;
        $status = $this->status;
        return view('sipedas.document.index', compact('Document', 'docName', 'docDesc', 'docType', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function UpdateDocumentDownloadCount(Request $request){
        $document_number_of_download = Document::findOrFail($request->id)->document_number_of_download;
        if( $document_number_of_download == null ){
            $document_number_of_download = 1;
        }else{
            $document_number_of_download = $document_number_of_download+1;
        }

        Document::findOrFail($request->id)->update(['document_number_of_download' => $document_number_of_download]);
    }
}

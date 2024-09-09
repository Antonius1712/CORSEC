<?php

namespace App\Http\Controllers\Admin\Sipedas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Model\Document;
use App\Model\History;
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

    public function __construct()
    {
        $this->status = [
            1 => 'Active',
            0 => 'Inactive'
        ];

        $this->docType = MasterDocument::pluck('document_type', 'id');
    }

    public function index()
    {
        $document = Document::with('history')->get();
        return view('admin.sipedas.document.index', compact('document'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = $this->status;
        $docType = $this->docType;
        return view('admin.sipedas.document.create', compact('status', 'docType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {

        // dd($request->all());
        $path = '';
        $upload = false;
        $user = Auth()->user()->UserId;

        if (isset($request->document_filename) && $request->document_filename != '') {
            $file = $request->file('document_filename');
            $filename = preg_replace("/[^a-z0-9\_\-\.]/i", '-', time() . '-' . $file->getClientOriginalName());
            $mime = $request->file('document_filename')->getClientMimeType();
            $specificPath = 'document_upload';

            if( $mime == 'image/png' || $mime == 'image/jpeg' || $mime == 'image/jpg' ){
                $path = 'images';
            }else if( $mime == 'application/pdf' ){
                $path = 'pdf';
            }

            $fullPath = $specificPath . '/' . $path;

            $upload = $this->uploadFile($file, $filename, $fullPath);
        }


        if( $upload ){
            try {
                $Document = new Document;
                $Document->document_type_id = $request->document_type_id;
                $Document->document_name = $request->document_name;
                $Document->document_filename = $filename;
                $Document->document_full_path = $fullPath;
                $Document->document_file_directory = $fullPath . '/' . $filename;
                $Document->status = $request->status;
                $Document->document_description = $request->document_description;
                $Document->created_by = $user;
                $Document->save();

                \Site::save_history($Document, $user, 'Save Document');

            } catch(\Exception $e) {
                return redirect()->back();
            }

            return redirect()->route('admin.sipedas.document.index');
        }else{
            return redirect()->back();
        }
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
        $status = $this->status;
        $docType = $this->docType;
        $document = Document::findOrFail($id);
        $history = History::where('document_id', $id)->with('getUser', 'getUser.getDept')->get();
        return view('admin.sipedas.document.edit', compact('status', 'docType', 'document', 'history'));
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
        // dd($request->all(), $id);

        $path = '';
        $upload = false;
        $user = Auth()->user()->UserId;

        if (isset($request->document_filename) && $request->document_filename != '') {
            $file = $request->file('document_filename');
            $filename = preg_replace("/[^a-z0-9\_\-\.]/i", '-', time() . '-' . $file->getClientOriginalName());
            $mime = $request->file('document_filename')->getClientMimeType();
            $specificPath = 'document_upload';

            if( $mime == 'image/png' || $mime == 'image/jpeg' || $mime == 'image/jpg' ){
                $path = 'images';
            }else if( $mime == 'application/pdf' ){
                $path = 'pdf';
            }

            $fullPath = $specificPath . '/' . $path;

            $upload = $this->uploadFile($file, $filename, $fullPath);
        }

        if( $upload ){
            try {
                $Document = Document::findOrFail($id);
                $Document->document_type_id = $request->document_type_id;
                $Document->document_name = $request->document_name;
                $Document->document_filename = $filename;
                $Document->document_full_path = $fullPath;
                $Document->document_file_directory = $fullPath . '/' . $filename;
                $Document->status = $request->status;
                $Document->document_description = $request->document_description;
                $Document->updated_by = $user;
                $Document->save();

                \Site::save_history($Document, $user, 'Update Document');

            } catch(\Exception $e) {
                return redirect()->back();
            }

            return redirect()->route('admin.sipedas.document.index');
        }else{
            try {
                $Document = Document::findOrFail($id);
                $Document->document_type_id = $request->document_type_id;
                $Document->document_name = $request->document_name;
                $Document->status = $request->status;
                $Document->document_description = $request->document_description;
                $Document->updated_by = $user;
                $Document->save();

                \Site::save_history($Document, $user, 'Update Document');

            } catch(\Exception $e) {
                return redirect()->back();
            }

            return redirect()->route('admin.sipedas.document.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Document = Document::findOrFail($id)->delete();
        \Site::save_history($Document, 'delete document');
        return redirect()->route('admin.sipedas.document.index');
    }

    public function uploadFile($file, $filename, $dir){
        try {
            if (!\File::isDirectory(public_path($dir))) \File::makeDirectory(public_path($dir), 0777, true);
            $check = $file->move($dir, $filename);
            return $check ? true : false;
        } catch(\Exception $ex) {
            return false;
        }
    }
}

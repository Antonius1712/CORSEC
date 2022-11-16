<?php

namespace App\Http\Controllers\Admin\Sipedas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterDocumentRequest;
use App\Model\MasterDocument;

class MasterDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // dd('s');
    }
    
    public function index()
    {
        $MasterDocumentList = MasterDocument::all();
        return view('admin.sipedas.master-document.index', compact('MasterDocumentList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sipedas.master-document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterDocumentRequest $request)
    {
        MasterDocument::create($request->validated());
        return redirect()->route('admin.sipedas.master-document.index');
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
        $masterDocument = MasterDocument::findOrFail($id);
        return view('admin.sipedas.master-document.edit', compact('masterDocument'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MasterDocumentRequest $request, $id)
    {
        MasterDocument::findOrFail($id)->update($request->validated());
        return redirect()->route('admin.sipedas.master-document.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MasterDocument::findOrFail($id)->delete();
        return redirect()->route('admin.sipedas.master-document.index');
    }
}

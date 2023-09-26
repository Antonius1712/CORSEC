@extends('admin.layouts.app')
@section('title')
    
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header bg-primary">
            <h2 class="text-white">Input Document</h2>
            <br/>
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.sipedas.document.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Document Name</label>
                            <input type="text" name="document_name" id="document_name " class="form-control">
                            @if($errors->has('document_name'))
                                <div class="error">{{ $errors->first('document_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Document Type</label>
                            <select name="document_type_id" id="document_type_id" class="form-control">
                                <option value="">Select</option>
                                @forelse ($docType as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @if($errors->has('document_type_id'))
                                <div class="error">{{ $errors->first('document_type_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="document_description" id="document_description" cols="30" rows="10" class="form-control"></textarea>
                            @if($errors->has('document_description'))
                                <div class="error">{{ $errors->first('document_description') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Select</option>
                                @forelse ($status as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @if($errors->has('status'))
                                <div class="error">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Upload File (Only for PDF, JPG, JPEG, PNG. Max 10MB)</label>
                            <input type="file" name="document_filename" id="document_filename" class="form-control">
                            @if($errors->has('document_filename'))
                                <div class="error">{{ $errors->first('document_filename') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="form-action">
                            <button type="submit" class="btn btn-warning">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    
@endsection
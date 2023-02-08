@extends('admin.layouts.app')
@section('title')
    
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header bg-primary">
            <h2 class="text-white">Input Document Type</h2>
            <br/>
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.sipedas.master-document.store') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" name="document_type" id="document_type " class="form-control">
                            @if($errors->has('document_type'))
                                <div class="error">{{ $errors->first('document_type') }}</div>
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
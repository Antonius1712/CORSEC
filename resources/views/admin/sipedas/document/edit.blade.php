@extends('admin.layouts.app')
@section('title')
    
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h2 class="text-white">Input Document</h2>
            <br/>
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.sipedas.document.update', $document->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Document Name</label>
                            <input value="{{ $document->document_name }}" type="text" name="document_name" id="document_name " class="form-control">
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
                                    <option {{ $key == $document->document_type_id ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
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
                            <textarea name="document_description" id="document_description" cols="30" rows="10" class="form-control">{{ $document->document_description }}</textarea>
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
                                    <option {{ $key == $document->status ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @if($errors->has('status'))
                                <div class="error">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <label>Dcoument Upload</label>
                        <input value="{{ $document->document_filename }}" type="text" name="display_filename" id="display_filename" class="form-control" readonly>
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

            <table class="table table-bordered mt-4">
                <thead class="thead-light">
                    <tr>
                        <th colspan="4" class="text-center"> <h2>History</h2> </th>
                    </tr>
                    <tr>
                        <th> Date/Time </th>
                        <th> Username </th>
                        <th> Department </th>
                        <th> Description </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($history as $key => $val)
                        <tr>
                            <td> {{ $val->created_at }} </td>
                            <td> {{ $val->username() }} </td>
                            <td> {{ $val->getUser->getDept->DeptName }} </td>
                            <td> {{ $val->action. ' ' .$val->description }} </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection
@section('script')
    {{-- <script>
        $('body').on('change', '#document_filename', function(){
            let filename = this.files.item(0).name;
            let filesize = this.files.item(0).size;
            let filetype = this.files.item(0).type;
            $('#display_filename').val(filename);
        });
    </script> --}}
@endsection
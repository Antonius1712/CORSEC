@extends('admin.layouts.app')
@section('title')
    
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h2 class="text-white">Document List</h2>
        </div>
        <div class="card-body">
            <a href="{{ Route('admin.sipedas.document.create') }}" class="btn btn-success pull-right mb-2">Add</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>Document Type</th>
                        <th>Document Desc</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Updated By</th>
                        <th>Updated At</th>
                        <th>Status</th>
                        <th>Last Log</th>
                        <th>Number of Download</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($document as $val)
                        <tr>
                            <td> {{ $val->document_name }} </td>
                            <td> {{ $val->master_document->document_type }} </td>
                            <td> {{ $val->document_description }} </td>
                            <td> {{ $val->created_by() }} </td>
                            <td> {{ $val->created_at }} </td>
                            <td> {{ $val->updated_by() }} </td>
                            <td> {{ $val->updated_at }} </td>
                            <td> {{ $val->status() }} </td>
                            <td> {{ $val->last_history_name(). ' ' . $val->last_history_desc() }} </td>
                            <td> {{ $val->document_number_of_download }} </td>
                            <td>
                                <a href="{{ Route('admin.sipedas.document.edit', $val->id) }}" class="btn btn-sm btn-outline-warning">
                                    Edit
                                </a>
                                <form action="{{ Route('admin.sipedas.document.destroy', $val->id) }}" method="post" style="display:inline-block;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    
@endsection
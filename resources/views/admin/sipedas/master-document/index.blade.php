@extends('admin.layouts.app')
@section('title')
    
@endsection
@section('content')
    <div class="card mt-4">
        <div class="card-header bg-primary">
            <h2 class="text-white">Master Document List</h2>
        </div>
        <div class="card-body">
            <a href="{{ Route('admin.sipedas.master-document.create') }}" class="btn btn-success pull-right mb-2">Add</a>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>Document Type</th>
                        <th>Document Desc</th>
                        <th>Created By</th>
                        <th>Updated By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($MasterDocumentList as $val)
                        <tr>
                            <td> {{ $val->document_type }} </td>
                            <td> {{ $val->document_description }} </td>
                            <td> {{ $val->created_by() }} </td>
                            <td> {{ $val->updated_by() }} </td>
                            <td> {{ $val->created_at }} </td>
                            {{-- !RIBET MINTA NYA KALO BARU CREATE UPDATED_AT NYA GA KE ISI, UDAH DEFAULT LARAVELNYA KEISI. --}}
                            <td> {{ $val->updated_at == $val->created_at ? '' : $val->updated_at }} </td>
                            <td>
                                <a href="{{ Route('admin.sipedas.master-document.edit', $val->id) }}" class="btn btn-sm btn-outline-warning">
                                    Edit
                                </a>
                                {{-- <a href="{{ Route('admin.sipedas.master-document.show', $val->id) }}" class="btn btn-sm btn-outline-primary">
                                    Show
                                </a> --}}
                                <form action="{{ Route('admin.sipedas.master-document.destroy', $val->id) }}" method="post" style="display:inline-block;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    
@endsection
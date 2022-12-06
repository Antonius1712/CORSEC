@extends('layouts.app')
@section('title')
    Document
@endsection
@section('css')
    
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <p>Document</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Document Name</label>
                        <select name="document_name" id="document_name" class="form-control">
                            <option value="">All</option>
                            @forelse ($docName as $key => $val)
                                <option value="{{ $val }}"> {{ $val }} </option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Document Type</label>
                        <select name="document_type" id="document_type" class="form-control">
                            <option value="">All</option>
                            @forelse ($docType as $key => $val)
                                <option value="{{ $val }}"> {{ $val }} </option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Document Description</label>
                        <select name="document_description" id="document_description" class="form-control">
                            <option value="">All</option>
                            @forelse ($docDesc as $key => $val)
                                <option value="{{ $val }}"> {{ $val }} </option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-3 col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">All</option>
                            @forelse ($status as $key => $val)
                                <option value="{{ $val }}"> {{ $val }} </option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-actions">
                        <button id="btn_search" class="btn btn-primary">Search</button>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-12 col-md-12 col-lg-12">
                    <table class="table table-striped" id="DataTable">
                        <thead>
                            <tr class="bg-info text-white">
                                <th> Document Name </th>
                                <th> Document Type </th>
                                <th> Document Desc </th>
                                <th> Last Update </th>
                                <th> Last Modifier </th>
                                <th> Last Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Document as $val)
                                <tr>
                                    <td> {{ $val->document_name }} </td>
                                    <td> {{ $val->master_document->document_type }} </td>
                                    <td> {{ $val->document_description }} </td>
                                    <td> {{ $val->updated_at }} </td>
                                    <td> {{ $val->updated_by() }} </td>
                                    <td> {{ $val->status() }} </td>
                                    <td>
                                        <a href="javascript:;" 
                                            data-id="{{ $val->id }}" 
                                            data-url="{{ asset($val->document_full_path.'/'.$val->document_filename) }}" 
                                            data-filename="{{ $val->document_filename }}" 
                                            id="btn_download" class="btn btn-info">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#DataTable').DataTable({
                searching : false,
                responsive:true
            });
        });

        $('body').on('click', '#btn_search', function(){
            $('#loading').show();
            reset_data_table();
            search_table();
            setTimeout(() => {
                $('#loading').hide();
            }, 100);
        });

        $('body').on('click', '#btn_download', function(){
            $('#loading').show();
            
            let id = $(this).data('id');
            let url = $(this).data('url');
            let filename = $(this).data('filename');

            update_document_download_count_then_download(url, filename, id);
        });

        function search_table(){
            let document_name = $('#document_name').val();
            let document_type = $('#document_type').val();
            let document_description = $('#document_description').val();
            let status = $('#status').val();

            let table = $('#DataTable').DataTable({
                responsive:true
            });

            if( document_name != '' ){
                table.column(0).search(document_name).draw();
            }

            if( document_type != '' ){
                table.column(1).search(document_type).draw();
            }

            if( document_description != '' ){
                table.column(2).search(document_description).draw();
            }

            if( status != '' ){
                table.column(3).search(status).draw();
            }
        }

        function reset_data_table(){
            $('#DataTable').DataTable().destroy();
        }

        function update_document_download_count_then_download(url, filename, id){
            let urlUpdate = '{{ Route("sipedas.document.update-document-download-count") }}';
            $.ajax({
                url: `${urlUpdate}/`,
                type: 'get',
                data: {
                    id: id
                },
                success:function(response){
                    /**/
                    console.log(response);
                    // return false;
                }
            }).then(function(){
                // return false;
                download(url, filename);
            }).then(function(){
                $('#loading').hide();
            });
        }

        function download(url, filename = null) {
            const anchor = document.createElement('a');
            anchor.href = url;
            anchor.download = filename;
            document.body.appendChild(anchor);
            anchor.click();
            document.body.removeChild(anchor);
        };
    </script>
@endsection
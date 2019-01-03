@extends('umadmin::admin.layouts.app')

@section('title', 'Dashboard')



@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="crud-container">
        <div class="app-content" style="background: #fafafa;padding: 20px;">
            <table class="table table-bordered" id="users-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            $.fn.dataTable.ext.errMode = 'throw';
            
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('venue.dataList') !!}',                
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });
    </script>
@stop




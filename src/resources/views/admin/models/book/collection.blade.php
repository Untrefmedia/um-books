@extends('umadmin::admin.layouts.app')

@section('title', 'Dashboard')



@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="crud-container">
        <div class="app-content" style="background: #fafafa;padding: 20px;">
            <table class="table table-bordered" id="users-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Turno</th>
                    <th>Institución</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('book.dataList') !!}',
                columnDefs: [ {
                    "targets": 2,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        let data = JSON.parse(cellData.replace(/&quot;/g,'"'));
                            $(td).html(data.institution_name)
                    }
                } ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'event_date_start', name: 'event_date_start'},
                    {data: 'detail', name: 'detail'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });
    </script>
@stop
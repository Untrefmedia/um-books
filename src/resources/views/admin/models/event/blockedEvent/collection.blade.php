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
                    <th>Fecha</th>
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
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('eventBlocked.dataList') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });
    </script>
@stop




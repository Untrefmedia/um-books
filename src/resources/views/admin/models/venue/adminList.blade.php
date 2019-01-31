@extends('umadmin::admin.layouts.app')

@section('title', 'Edit Venue')


@section('content')

<h1 class="page-header">Editar Admin</h1>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Información</h3>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-7 col-sm-offset-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if(Session::has('guardado'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('guardado', '')}}
                </div>
            @endif
        </div>  
    </div>

  
    <div class="panel-body">

        {!! Form::open(array('route' => ['venueAdmin.update', $venue->id], 'method' => 'POST', 'enctype'=>"multipart/form-data", 'class' => 'form-horizontal')) !!}

        {!! Form::token() !!}

        {!! Form::hidden('id', $venue->id) !!}


        <div class="form-group">
            <div class="form-group">
                {!! Form::label('', 'Admin:', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-9">
                    @php($tildar = false)

                    @foreach($admins as $admin)
                        @if(in_array($admin->id, $admin_of_venue))
                            @php($tildar = true)
                        @else
                            @php($tildar = false)
                        @endif
                        
                        {{-- checkbox --}}
                        {{ Form::checkbox('admin[]', $admin->id, $tildar) }}
                        <span>{{$admin->name}}</span>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            {!! Form::submit() !!}<br>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@stop

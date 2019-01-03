@extends('umadmin::admin.layouts.app')

@section('title', 'Edit User')


@section('content')

<h1 class="page-header">Editar Usuario</h1>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Información personal</h3>
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

        {!! Form::open(array('route' => ['event.update', $user->id],  'method' => 'PATCH','enctype'=>"multipart/form-data", 'class' => 'form-horizontal')) !!}

        {!!   Form::token() !!}

        {!! Form::hidden('id', $user->id) !!}


        <div class="form-group">
            {!! Form::label('', 'Nombre:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Email:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
            </div>
        </div>

        {{-- <div class="form-group">
            {!! Form::label('', 'Password:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div> --}} 

        <div class="form-group text-center">
            {!! Form::submit() !!}<br>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@stop

@extends('umadmin::admin.layouts.app')

@section('title', 'Edit Venue')


@section('content')

<h1 class="page-header">Editar Venue</h1>

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

        {!! Form::open(array('route' => ['venue.update', $venue->id],  'method' => 'PATCH','enctype'=>"multipart/form-data", 'class' => 'form-horizontal')) !!}

        {!!   Form::token() !!}

        {!! Form::hidden('id', $venue->id) !!}


        <div class="form-group">
            {!! Form::label('', 'Título:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('title', $venue->title, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Descripción:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('description', $venue->description, ['class' => 'form-control summer']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Dirección 1:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('address1', $venue->address1, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Dirección 2:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('address2', $venue->address2, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Ciudad:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('city', $venue->city, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Provincia:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('state', $venue->state, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Código Postal:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('postcode', $venue->postcode, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'País:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('country', $venue->country, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'URL:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('url', $venue->url, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Teléfono:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('phone', $venue->phone, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Latitud:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('latitude', $venue->latitude, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Longitud:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('longitude', $venue->longitude, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group text-center">
            {!! Form::submit() !!}<br>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@stop

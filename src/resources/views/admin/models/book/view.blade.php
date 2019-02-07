@extends('umadmin::admin.layouts.app')

@section('title', 'Ver Book')


@section('content')

<h1 class="page-header">Ver Reserva</h1>

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

        <div class="form-group">
            {!! Form::label('', 'Turno elegido:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
            <div>{{$book->event_date_start}}</div>
            </div>
        </div>

        <div class="form-group">
        {!! Form::label('', 'Nombre:', ['class' => 'col-sm-3']) !!}
        <div class="col-sm-9">
        <div>{{$detail->name}}</div>
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('', 'Apellido:', ['class' => 'col-sm-3']) !!}
        <div class="col-sm-9">
        <div>{{$detail->surname}}</div>
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('', 'Institución Nombre:', ['class' => 'col-sm-3']) !!}
        <div class="col-sm-9">
        <div>{{$detail->institution_name}}</div>
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('', 'Institución Responsable:', ['class' => 'col-sm-3']) !!}
        <div class="col-sm-9">
        <div>{{$detail->institution_responsable}}</div>
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('', 'Institución Dirección:', ['class' => 'col-sm-3']) !!}
        <div class="col-sm-9">
        <div>{{$detail->institution_address}}</div>
        </div>
        </div>


        <div class="form-group">
        {!! Form::label('', 'Institución Email:', ['class' => 'col-sm-3']) !!}
        <div class="col-sm-9">
        <div>{{$detail->institution_email}}</div>
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('', 'Institución Teléfono:', ['class' => 'col-sm-3']) !!}
        <div class="col-sm-9">
        <div>{{$detail->institution_phone}}</div>
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('', 'Institución Localidad:', ['class' => 'col-sm-3']) !!}
        <div class="col-sm-9">
            <div>{{$detail->institution_city}}</div>
        </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Institución Ubicación:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->institution_location}}</div>
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('', 'Institución Tipo:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->institution_type}}</div>
            </div>
        </div>        

        <div class="form-group">
            {!! Form::label('', 'Institución Dependencia:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->institution_dependency}}</div>
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('', 'Grupo: Nivel', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->group_level}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Grupo Curso:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->group_course}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Grupo Cantidad de alumnos:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->group_numberOfStudents}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Grupo Cantidad de acompañantes:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->group_numberOfCompanions}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Docente Nombre y apellido:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->teacher_name}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Docente Email:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->teacher_email}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Docente Teléfono:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->teacher_phone}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Docente Asignatura que dicta:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->teacher_subject}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Cantidad de integrantes del grupo:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->numberOfGroupMembers}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Propósito de la visita:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->purpose}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Idioma necesario en la visita:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->language}}</div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Cómo supo del museo:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->know}}</div>
            </div>
        </div>        


        <div class="form-group">
            {!! Form::label('', 'Comentarios y Preguntas:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                <div>{{$detail->comments}}</div>
            </div>
        </div>

<style>

.form-group{

    padding-top:30px
}


</style>

        {!! Form::close() !!}
    </div>
</div>
@stop

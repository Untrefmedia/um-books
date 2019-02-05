
@extends('umadmin::admin.layouts.app')

@section('title', 'Create Event')

@section('css')

<link rel="stylesheet" media="all" type="text/css" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css" />


<style type="text/css">
   
    #tabs{ margin: 20px -20px; border: none; }
    #tabs, #ui-datepicker-div, .ui-datepicker{ font-size: 85%; }
    .clear{ clear: both; }

    .example-container{ background-color: #f4f4f4; border-bottom: solid 2px #777777; margin: 0 0 20px 40px; padding: 20px; }
    .example-container input{ border: solid 1px #aaa; padding: 4px; width: 175px; }
    .ebook{}
    .ebook img.ebookimg{ float: left; margin: 0 15px 15px 0; width: 100px; }
    .ebook .buyp a iframe{ margin-bottom: -5px; }
</style>

@endsection

@section('content')




<h1 class="page-header">Crear Evento</h1>

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

        {!! Form::open(array('route' => 'event.store',  'method' => 'POST','enctype'=>"multipart/form-data", 'class' => 'form-horizontal')) !!}

        {!! Form::token() !!}

        <div class="form-group">
            {!! Form::label('', 'Título:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('title', '', ['class' => 'form-control']) !!}
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('', 'Fecha y hora:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('start_date', '', ['class' => 'form-control start_date','autocomplete'=>"off"]) !!}
            </div>
        </div>


       

        <div class="form-group" style="margin-top: 18px;">
                {!! Form::label('', 'Dias del evento:', ['class' => 'col-sm-9','style'=>'position:absolute']) !!}
                <div class="col-sm-1 col-sm-offset-3" style="width: 15%;">Lunes </div>
                <div class="col-sm-7"><input type="checkbox" name="byday[]" value="MO" ><br></div>

                <div class="col-sm-1 col-sm-offset-3" style="width: 15%;">Martes </div>
                <div class="col-sm-7"><input type="checkbox" name="byday[]" value="TU" ><br></div>

                <div class="col-sm-1 col-sm-offset-3" style="width: 15%;">Miercoles </div>
                <div class="col-sm-7"><input type="checkbox" name="byday[]" value="WE" ><br></div>

                <div class="col-sm-1 col-sm-offset-3" style="width: 15%;">Jueves </div>
                <div class="col-sm-7"><input type="checkbox" name="byday[]" value="TH"><br></div>

                <div class="col-sm-1 col-sm-offset-3" style="width: 15%;">Viernes </div>
                <div class="col-sm-7"><input type="checkbox" name="byday[]" value="FR" ><br></div>

                <div class="col-sm-1 col-sm-offset-3" style="width: 15%;">Sabado </div>
                <div class="col-sm-7"><input type="checkbox" name="byday[]" value="SA"><br></div>

                <div class="col-sm-1 col-sm-offset-3" style="width: 15%;">Domingo </div>
                <div class="col-sm-7"><input type="checkbox" name="byday[]" value="SU" ><br></div> 

     </div>

     <div class="form-group">
            {!! Form::label('', 'Museos:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
            {{ Form::select('venue_id', $venues, null, array('class'=>'form-control', 'placeholder'=>'Please select ...')) }}
            </div>
        </div>


     <div class="form-group">
            {!! Form::label('', 'Frecuencia:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                    <select class="form-control" id="freq" name="freq">
                            <option value="DAILY" >Diariamente</option>
                            <option value="WEEKLY">Semanalmente</option>
                            <option value="MONTHLY">Mensualmente</option>
                            <option value="YEARLY">Anualmente</option>
                    </select>
            </div>
        </div>


        
        <div class="form-group" style="margin-left:8px;margin-top: 80px;" >
            {!! Form::submit() !!}<br>
        </div>

        {!! Form::close() !!}
    </div>
</div>



@stop

@section('js')


{{-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
<script type="text/javascript" src="//code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="https://trentrichardson.com/examples/timepicker/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script type="text/javascript" src="https://trentrichardson.com/examples/timepicker/jquery-ui-sliderAccess.js"></script>


<script>


$.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: '',
//  beforeShowDay: DisableSpecificDates,
//     minDate: 1
};
$.datepicker.setDefaults($.datepicker.regional['es']);

$.timepicker.regional['es'] = {
    timeText: 'Hora',
    currentText: 'Actual',
    closeText: 'Aceptar',
    timeFormat: 'HH:mm',
    amNames: ['AM', 'A'],
    pmNames: ['PM', 'P'],
    isRTL: false
};
$.timepicker.setDefaults($.timepicker.regional['es']);


$('.start_date').datetimepicker({
	addSliderAccess: true,
	sliderAccessArgs: { touchonly: false }
});

</script>

@endsection

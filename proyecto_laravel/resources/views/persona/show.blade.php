@extends('persona.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Mostrar </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('persona.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cedula:</strong>
                {{ $persona->cedula }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $persona->nombre }}
            </div>
        </div>



 <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Apellidos:</strong>
                {{ $persona->apellidos }}
            </div>
        </div>


         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fecha Nacimiento:</strong>
                {{ $persona->fecha_nacimiento }}
            </div>
        </div>


    </div>
@endsection
@extends('cliente.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Mostrar </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('cliente.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $cliente->nombre }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tipo:</strong>
                {{ $cliente->tipo }}
            </div>
        </div>
     <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>identificacion:</strong>
                {{ $cliente->identificacion }}
            </div>
        </div>


         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>direccion:</strong>
                {{ $cliente->direccion }}
            </div>
        </div>

             <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>contacto:</strong>
                {{ $cliente->contacto }}
            </div>
        </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>telefono:</strong>
                {{ $cliente->telefono }}
            </div>
        </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>correo:</strong>
                {{ $cliente->correo }}
            </div>
        </div>


    </div>
@endsection
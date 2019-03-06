@extends('factura.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Mostrar </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('factura.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>fecha:</strong>
                {{ $factura->fecha }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>moneda:</strong>
                {{ $factura->moneda }}
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>tipo_cambio:</strong>
                {{ $factura->tipo_cambio }}
            </div>
        </div>


         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>cliente:</strong>
                {{ $factura->cliente }}
            </div>
        </div>

   <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>producto1:</strong>
                {{ $factura->producto1 }}
            </div>
        </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>producto2:</strong>
                {{ $factura->producto2 }}
            </div>
        </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>producto3:</strong>
                {{ $factura->producto3 }}
            </div>
        </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>subtotal:</strong>
                {{ $factura->subtotal }}
            </div>
        </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>descuento:</strong>
                {{ $factura->descuento }}
            </div>
        </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>total:</strong>
                {{ $factura->total }}
            </div>

    </div>
@endsection
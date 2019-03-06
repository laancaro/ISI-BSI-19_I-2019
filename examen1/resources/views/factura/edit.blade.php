@extends('factura.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar factura</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('factura.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Hubo un problema al editar.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('factura.update',$factura->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
          
                <div class="form-group">
                    <strong>fecha:</strong>
                    <input type="datetime" name="nombre" value="{{ $factura->fecha }}" class="form-control" placeholder="fecha">
                </div>
          
                <div class="form-group">
                    <strong>moneda:</strong>
                    <input type="text" name="tipo" value="{{ $factura->moneda }}" class="form-control" placeholder="moneda">
                </div>

           
                <div class="form-group">
                    <strong>tipo_cambio:</strong>
                    <input type="text" name="tipo_cambio" value="{{ $factura->tipo_cambio }}" class="form-control" placeholder="tipo_cambio">
                </div>
           
          
                <div class="form-group">
                    <strong>cliente:</strong>
                    <input type="number" name="cliente" value="{{ $factura->cliente }}" class="form-control" placeholder="cliente">
                </div>
              
                <div class="form-group">
                    <strong>producto1:</strong>
                    <input type="number" name="producto1" value="{{ $factura->producto1 }}" class="form-control" placeholder="producto1">
                </div>
              
                <div class="form-group">
                    <strong>producto2:</strong>
                    <input type="number" name="producto2" value="{{ $factura->producto2 }}" class="form-control" placeholder="producto2">
                </div>
              
                <div class="form-group">
                    <strong>producto3:</strong>
                    <input type="number" name="producto3" value="{{ $factura->producto3 }}" class="form-control" placeholder="producto3">
                </div>
              
                <div class="form-group">
                    <strong>subtotal:</strong>
                    <input type="number" name="subtotal" value="{{ $factura->subtotal }}" class="form-control" placeholder="subtotal">
                </div>
              
                <div class="form-group">
                    <strong>descuento:</strong>
                    <input type="number" name="descuento" value="{{ $factura->descuento }}" class="form-control" placeholder="descuento">
                </div>
              
                <div class="form-group">
                    <strong>impuestos:</strong>
                    <input type="number" name="impuestos" value="{{ $factura->impuestos }}" class="form-control" placeholder="impuestos">
                </div>

              
                <div class="form-group">
                    <strong>total:</strong>
                    <input type="number" name="total" value="{{ $factura->total }}" class="form-control" placeholder="total">
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
   
    </form>
@endsection
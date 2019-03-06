@extends('factura.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Agregar Nuevo factura</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('factura.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Hubo un problema al ingresar el dato.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('factura.store') }}" method="POST">
    @csrf
  
     <div class="row"> 
          <div class="form-group">
               
                <input type="hidden" name="id" class="form-control" placeholder="id" >
            </div>
      
            <div class="form-group">
                <strong>fecha:</strong>
                <input type="datetime-local" name="fecha" class="form-control" placeholder="fecha" value="<?php echo date('Y-m-d').'T'.date('H:i'); ?>">
            </div>
        
      
            <div class="form-group">
                <strong>moneda:</strong>
                <input type="text" name="moneda" class="form-control" placeholder="moneda">
            </div>
      
            <div class="form-group">
                <strong>tipo_cambio:</strong>
                <input type="number" name="tipo_cambio" class="form-control" placeholder="tipo_cambio">
            </div>
     
      
        <div class="form-group">
            <strong>cliente:</strong>

            <select name="cliente" class="form-control">
            @if (isset($clientes))
            @foreach($clientes as $id => $nombre)
            <option value="{{$id }}" >{{$nombre}}</option>
            @endforeach
            @endif
            </select>  
        </div>
       
        <div class="form-group">
            <strong>producto1:</strong>

            <select name="producto1" class="form-control">
            @if (isset($productos))
            @foreach($productos as $id => $nombre)
            <option value="{{$id }}" >{{$nombre}}</option>
            @endforeach
            @endif
            </select>  
        </div>
       
        <div class="form-group">
            <strong>producto2:</strong>

            <select name="producto2" class="form-control">
            @if (isset($productos))
            @foreach($productos as $id => $nombre)
            <option value="{{$id }}" >{{$nombre}}</option>
            @endforeach
            @endif
            </select>  
        </div>
       
        <div class="form-group">
            <strong>producto3:</strong>

            <select name="producto3" class="form-control">
            @if (isset($productos))
            @foreach($productos as $id => $nombre)
            <option value="{{$id }}" >{{$nombre}}</option>
            @endforeach
            @endif
            </select>  
        </div>

        <div class="form-group">
            <strong>subtotal:</strong>
            <input type="number" name="subtotal" class="form-control" placeholder="subtotal">
        </div>
       
        <div class="form-group">
            <strong>descuento:</strong>
            <input type="number" name="descuento" class="form-control" placeholder="descuento">
        </div>
       
        <div class="form-group">
            <strong>impuestos:</strong>
            <input type="number" name="impuestos" class="form-control" placeholder="impuestos">
        </div>
          <div class="form-group">
            <strong>total:</strong>
            <input type="number" name="total" class="form-control" placeholder="total">
        </div>



        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>
    </div>
   
</form>
@endsection
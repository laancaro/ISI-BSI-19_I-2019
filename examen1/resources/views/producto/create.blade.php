@extends('producto.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Agregar Nuevo Producto</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('producto.index') }}"> Back</a>
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
   
<form action="{{ route('producto.store') }}" method="POST">
    @csrf
  
     <div class="row">
      
            <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre">
            </div>
      
            <div class="form-group">
                <strong>Tipo:</strong>
                <input type="number" name="tipo" class="form-control" placeholder="tipo">
            </div>



            <div class="form-group">
                <strong>Descripcion:</strong>
                <input type="text" name="descripcion" class="form-control" placeholder="Descripcion">
            </div>
      
            <div class="form-group">
                <strong>Costo Unitario:</strong>
                <input type="number" name="costo_unitario" class="form-control" placeholder="costo_unitario">
            </div>


        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>
    </div>
   
</form>
@endsection
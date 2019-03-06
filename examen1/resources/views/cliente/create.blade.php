@extends('cliente.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Agregar Nuevo Cliente</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('cliente.index') }}"> Back</a>
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
   
<form action="{{ route('cliente.store') }}" method="POST">
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
                <strong>Identificacion:</strong>
                <input type="text" name="identificacion" class="form-control" placeholder="identificacion">
            </div>
      
            <div class="form-group">
                <strong>direccion:</strong>
                <input type="text" name="direccion" class="form-control" placeholder="direccion">
            </div>

           
            <div class="form-group">
                <strong>contacto:</strong>
                <input type="text" name="contacto" class="form-control" placeholder="contacto">
            </div>


    
            <div class="form-group">
                <strong>telefono:</strong>
                <input type="number" name="telefono" class="form-control" placeholder="telefono">
            </div>
      
            <div class="form-group">
                <strong>correo:</strong>
                <input type="email" name="correo" class="form-control" placeholder="correo">
            </div>


        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>
    </div>
   
</form>
@endsection
@extends('persona.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Agregar Nueva Persona</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('persona.index') }}"> Back</a>
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
   
<form action="{{ route('persona.store') }}" method="POST">
    @csrf
  
     <div class="row">
      
            <div class="form-group">
                <strong>Cedula:</strong>
                <input type="text" name="cedula" class="form-control" placeholder="Cedula">
            </div>
      
            <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" name="nombre" class="form-control" placeholder="nombre">
            </div>



            <div class="form-group">
                <strong>Apellidos:</strong>
                <input type="text" name="apellidos" class="form-control" placeholder="apellidos">
            </div>
      
            <div class="form-group">
                <strong>Fecha Nacimiento:</strong>
                <input type="date" name="fecha_nacimiento" class="form-control" placeholder="fecha_nacimiento">
            </div>


        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>
    </div>
   
</form>
@endsection
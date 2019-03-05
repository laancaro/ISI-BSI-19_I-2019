@extends('trabajador.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Agrgar Nuevo Trabajador</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('trabajador.index') }}"> Back</a>
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
   
<form action="{{ route('trabajador.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cedula:</strong>
                <input type="text" name="cedula" class="form-control" placeholder="cedula">
            </div>


  <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>provincia:</strong>
                <input type="text" name="provincia" class="form-control" placeholder="provincia">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>canton:</strong>
                <input type="text" name="canton" class="form-control" placeholder="canton">
            </div>


    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>distrito:</strong>
                <input type="text" name="distrito" class="form-control" placeholder="distrito">
            </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>direccion:</strong>
                <input type="text" name="direccion" class="form-control" placeholder="direccion">
            </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>telefono:</strong>
                <input type="number" name="telefono" class="form-control" placeholder="telefono">
            </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>celular:</strong>
                <input type="number" name="celular" class="form-control" placeholder="celular">
            </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>correo:</strong>
                <input type="text" name="correo" class="form-control" placeholder="correo">
            </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ocupacion:</strong>
                <input type="text" name="ocupacion" class="form-control" placeholder="ocupacion">
            </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>grado_academico:</strong>
                <input type="number" name="grado_academico" class="form-control" placeholder="grado_academico">
            </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>fecha_nacimiento:</strong>
                <input type="date" name="fecha_nacimiento" class="form-control" placeholder="fecha_nacimiento">
            </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>banco:</strong>
                <input type="text" name="banco" class="form-control" placeholder="banco">
            </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>num_cuenta_banco:</strong>
                <input type="text" name="num_cuenta_banco" class="form-control" placeholder="num_cuenta_banco">
            </div>





        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Ingresar</button>
        </div>
    </div>
   
</form>
@endsection
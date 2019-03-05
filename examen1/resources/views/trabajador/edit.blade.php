@extends('trabajador.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar trabajador</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('trabajador.index') }}"> Back</a>
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
  
    <form action="{{ route('trabajador.update',$trabajador->cedula) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="nombre" value="{{ $trabajador->nombre }}" class="form-control" placeholder="Nombre">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>cedula:</strong>
                    <input type="text" name="nombre" value="{{ $trabajador->cedula }}" class="form-control" placeholder="cedula">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>provincia:</strong>
                    <input type="text" name="provincia" value="{{ $trabajador->provincia }}" class="form-control" placeholder="provincia">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>canton:</strong>
                    <input type="text" name="canton" value="{{ $trabajador->canton }}" class="form-control" placeholder="canton">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>distrito:</strong>
                    <input type="text" name="distrito" value="{{ $trabajador->distrito }}" class="form-control" placeholder="distrito">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>direccion:</strong>
                    <input type="text" name="direccion" value="{{ $trabajador->direccion }}" class="form-control" placeholder="direccion">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>telefono:</strong>
                    <input type="number" name="telefono" value="{{ $trabajador->telefono }}" class="form-control" placeholder="telefono">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>celular:</strong>
                    <input type="number" name="celular" value="{{ $trabajador->celular }}" class="form-control" placeholder="celular">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>correo:</strong>
                    <input type="text" name="correo" value="{{ $trabajador->correo }}" class="form-control" placeholder="correo">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ocupacion:</strong>
                    <input type="text" name="ocupacion" value="{{ $trabajador->ocupacion }}" class="form-control" placeholder="ocupacion">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>grado_academico:</strong>
                    <input type="text" name="grado_academico" value="{{ $trabajador->grado_academico }}" class="form-control" placeholder="grado_academico">
                </div>
            </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>fecha_nacimiento:</strong>
                    <input type="date" name="fecha_nacimiento" value="{{ $trabajador->fecha_nacimiento }}" class="form-control" placeholder="fecha_nacimiento">
                </div>
            </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>banco:</strong>
                    <input type="text" name="banco" value="{{ $trabajador->banco }}" class="form-control" placeholder="banco">
                </div>
            </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>num_cuenta_banco:</strong>
                    <input type="text" name="num_cuenta_banco" value="{{ $trabajador->num_cuenta_banco }}" class="form-control" placeholder="num_cuenta_banco">
                </div>
            </div>
           

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
   
    </form>
@endsection
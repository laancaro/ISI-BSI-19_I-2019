@extends('cliente.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar cliente</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('cliente.index') }}"> Back</a>
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
  
    <form action="{{ route('cliente.update',$cliente->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="nombre" value="{{ $cliente->nombre }}" class="form-control" placeholder="Nombre">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tipo:</strong>
                    <input type="number" name="tipo" value="{{ $cliente->tipo }}" class="form-control" placeholder="Tipo">
                </div>
                </div>

             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>identificacion:</strong>
                    <input type="text" name="identificacion" value="{{ $cliente->identificacion }}" class="form-control" placeholder="identificacion">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>direccion:</strong>
                    <input type="text" name="direccion" value="{{ $cliente->direccion }}" class="form-control" placeholder="direccion">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>contacto:</strong>
                    <input type="text" name="contacto" value="{{ $cliente->contacto }}" class="form-control" placeholder="contacto">
                </div>
                </div>

             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>telefono:</strong>
                    <input type="number" name="telefono" value="{{ $cliente->telefono }}" class="form-control" placeholder="telefono">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>correo:</strong>
                    <input type="email" name="correo" value="{{ $cliente->correo }}" class="form-control" placeholder="correo">
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
   
    </form>
@endsection
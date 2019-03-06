@extends('producto.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Producto</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('producto.index') }}"> Back</a>
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
  
    <form action="{{ route('producto.update',$producto->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
          
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" placeholder="Nombre">
                </div>
          
                <div class="form-group">
                    <strong>Tipo:</strong>
                    <input type="number" name="tipo" value="{{ $producto->tipo }}" class="form-control" placeholder="Tipo">
                </div>
      
                <div class="form-group">
                    <strong>Descripcion:</strong>
                    <input type="text" name="descripcion" value="{{ $producto->descripcion }}" class="form-control" placeholder="descripcion">
                </div>
            </div>
          
                <div class="form-group">
                    <strong>Costo Unitario:</strong>
                    <input type="number" name="costo_unitario" value="{{ $producto->costo_unitario }}" class="form-control" placeholder="Costo_unitario">
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
   
    </form>
@endsection
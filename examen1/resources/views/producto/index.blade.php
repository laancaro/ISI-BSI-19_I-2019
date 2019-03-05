@extends('producto.layout')
 
@section('content')
 <br>
  <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Mantenimiento de Productos. Tarea Progra avanzada</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('producto.create') }}"> Nuevo Producto</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   <a href="{{ url('/') }}">Menu Inicio</a>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Descripcion</th>
            <th>Costo_Unitario</th>
            <th width="280px">Acción</th>
        </tr>
        @foreach ($producto as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->nombre }}</td>
            <td>{{ $product->tipo }}</td>
            <td>{{ $product->descripcion }}</td>
            <td>{{ $product->costo_unitario }}</td>
            <td align="center">
                    <form action="{{ route('producto.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('producto.show',$product->id) }}">Mostrar</a>
                    <br>
                    <a class="btn btn-primary" href="{{ route('producto.edit',$product->id) }}">Editar</a>
                    <br>
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $producto->links() !!}
      
@endsection
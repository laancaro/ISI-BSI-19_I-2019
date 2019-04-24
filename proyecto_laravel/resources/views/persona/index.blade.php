@extends('persona.layout')
 
@section('content')
 <br>
  <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Proyecto</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('persona.create') }}"> Nueva Persona</a>
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
			<th>ID</th>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Fecha Nacimiento</th>
            <th width="280px">Acción</th>
        </tr>
        @foreach ($persona as $product)
        <tr>
			<td>{{ ++$i }}</td>
            <td>{{ $product->cedula }}</td>
            <td>{{ $product->nombre }}</td>
            <td>{{ $product->apellidos }}</td>
            <td>{{ $product->fecha_nacimiento }}</td>
            <td align="center">
                    <form action="{{ route('persona.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('persona.show',$product->id) }}">Mostrar</a>
                    <br>
                    <a class="btn btn-primary" href="{{ route('persona.edit',$product->id) }}">Editar</a>
                    <br>
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $persona->links() !!}
      
@endsection
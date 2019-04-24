@extends('medicamento.layout')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Proyecto Farmacia</h2>
            </div>
            <div class="pull-right">
               <a class="btn btn-success" href="{{ route('medicamento.create') }}">Creacion de Registro</a>
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

            <th>id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Casa Farmaceutica</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($medicamento as $product)

        <tr>
            <td>{{ ++$i }}</td>
			<td>{{ $product->nombre }}</td>
            <td>{{ $product->descripcion }}</td>
            <td>{{ $product->casa_farmaceutica }}</td>
        
            <td align="center">

                <form action="{{ route('medicamento.destroy',$product->id) }}" method="POST">
 
                    <a class="btn btn-info" href="{{ route('medicamento.show',$product->id) }}">Mostar</a>
                    <br>
                    <a class="btn btn-primary" href="{{ route('medicamento.edit',$product->id) }}">Editar</a>
                    <br>
                    @csrf

                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Eliminar</button>

                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $medicamento->links() !!}
     
@endsection
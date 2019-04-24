@extends('receta.layout')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Proyecto Farmacia</h2>
            </div>
            <div class="pull-right">
               <a class="btn btn-success" href="{{ route('receta.create') }}">Creacion de Registro</a>
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
            <th>persona</th>
            <th>medicamento</th>
            <th>cantidad</th>
            <th>usuario</th>
            <th>fecha_entrega</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($receta as $product)

        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->persona }}</td>
            <td>{{ $product->medicamento }}</td>
            <td>{{ $product->cantidad }}</td>
            <td>{{ $product->usuario }}</td>
            <td>{{ $product->fecha_entrega }}</td>
        
            <td align="center">
                <form action="{{ route('receta.destroy',$product->id) }}" method="POST">
 
                    <a class="btn btn-info" href="{{ route('receta.show',$product->id) }}">Mostar</a>
                    <br>
                    <a class="btn btn-primary" href="{{ route('receta.edit',$product->id) }}">Editar</a>
                    <br>
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
 
    {!! $receta->links() !!}
     
@endsection
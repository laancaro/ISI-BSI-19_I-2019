@extends('cliente.layout')
 
@section('content')
 <br>
  <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Mantenimiento de clientes. Tarea Progra avanzada</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('cliente.create') }}"> Nuevo cliente</a>
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
            <th>Identificacion</th>
            <th>Dirección</th>
            <th>Contacto</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th width="280px">Acción</th>
        </tr>
        @foreach ($cliente as $client)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $client->nombre }}</td>
            <td>{{ $client->tipo }}</td>
            <td>{{ $client->identificacion }}</td>
            <td>{{ $client->direccion }}</td>
            <td>{{ $client->contacto }}</td>
            <td>{{ $client->telefono }}</td>
            <td>{{ $client->correo }}</td>
            <td align="center">
                    <form action="{{ route('cliente.destroy',$client->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('cliente.show',$client->id) }}">Mostrar</a>
                    <br>
                    <a class="btn btn-primary" href="{{ route('cliente.edit',$client->id) }}">Editar</a>
                    <br>
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $cliente->links() !!}
      
@endsection
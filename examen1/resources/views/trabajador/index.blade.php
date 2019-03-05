@extends('trabajador.layout')
 
@section('content')
 <br>
  <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Mantenimiento de trabajadors. Tarea Progra avanzada</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('trabajador.create') }}"> Nuevo trabajador</a>
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
                <th>Nombre</th>
                <th>ceuula</th>
                <th>provincia</th>
                <th>canton</th>
                <th>distrito</th>
                <th>direccion</th>
                <th>telefono</th>
                <th>celular</th>
                <th>correo</th>
                <th>ocupacion</th>
                <th>grado_academico</th>
                <th>fecha_nacimiento</th>
                <th>bancho</th>
                <th>num_cuenta_banco</th>

            <th width="280px">Acción</th>
        </tr>
        @foreach ($trabajador as $worker)
        <tr>            
            <td>{{ $worker->nombre }}</td>
            <td>{{ $worker->cedula }}</td>
            <td>{{ $worker->provincia }}</td>
            <td>{{ $worker->canton }}</td>
            <td>{{ $worker->distrito }}</td>
            <td>{{ $worker->direccion }}</td>
            <td>{{ $worker->telefono }}</td>
            <td>{{ $worker->celular }}</td>
            <td>{{ $worker->correo }}</td>
            <td>{{ $worker->ocupacion }}</td>
            <td>{{ $worker->grado_academico }}</td>
            <td>{{ $worker->fecha_nacimiento }}</td>
            <td>{{ $worker->banco }}</td>
            <td>{{ $worker->num_cuenta_bancaria }}</td>
            <td align="center">
                    <form action="{{ route('trabajador.destroy',$worker->cedula) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('trabajador.show',$worker->cedula) }}">Mostrar</a>
                    <br>
                    <a class="btn btn-primary" href="{{ route('trabajador.edit',$worker->cedula) }}">Editar</a>
                    <br>
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $trabajador->links() !!}
      
@endsection
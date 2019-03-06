@extends('factura.layout')
 
@section('content')
 <br>
  <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Mantenimiento de facturas. Tarea Progra avanzada</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('factura.create') }}"> Nuevo factura</a>
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
            <th>fecha</th>
            <th>moneda</th>
            <th>tipo_cambio</th>
            <th>cliente</th>
            <th>producto1</th>
            <th>producto2</th>
            <th>producto3</th>
            <th>subtotal</th>
            <th>descuento</th>
            <th>impuestos</th>
            <th>total</th>
            
            <th width="280px">Acción</th>
        </tr>
        @foreach ($factura as $facturas)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $facturas->fecha }}</td>
            <td>{{ $facturas->moneda }}</td>
            <td>{{ $facturas->tipo_cambio }}</td>
            <td>{{ $facturas->cliente }}</td>
            <td>{{ $facturas->producto1 }}</td>
            <td>{{ $facturas->producto2 }}</td>
            <td>{{ $facturas->producto3 }}</td>
            <td>{{ $facturas->subtotal }}</td>
            <td>{{ $facturas->descuento }}</td>
            <td>{{ $facturas->impuestos }}</td>
            <td>{{ $facturas->total }}</td>
            <td align="center">
                    <form action="{{ route('factura.destroy',$facturas->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('factura.show',$facturas->id) }}">Mostrar</a>
                    <br>
                    <a class="btn btn-primary" href="{{ route('factura.edit',$facturas->id) }}">Editar</a>
                    <br>
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $factura->links() !!}
      
@endsection
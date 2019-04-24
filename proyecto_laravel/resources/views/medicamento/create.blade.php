@extends('medicamento.layout') 
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Almacenamiento de Medicamentos</h2>
        </div>

        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('medicamento.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Whoops!</strong> Algunos inconvenientes para el ingreso de datos.<br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif   

<form action="{{ route('medicamento.store') }}" method="POST">

    @csrf
  
     <div class="row">
             <div class="form-group">
                <strong>Nombre:</strong>
               <textarea class="form-control" style="height:150px" name="nombre" placeholder="Nombre"></textarea>
            </div>

            <div class="form-group">
                <strong>Descripcion:</strong>
                <input type="text" name="descripcion" class="form-control" placeholder="descripcion">
            </div>

            <div class="form-group">
                <strong>Casa Farmaceutica:</strong>
                <input type="number" name="casa_farmaceutica" class="form-control" placeholder="casa_farmaceutica">
            </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Aceptar</button>
        </div>
    </div> 
</form>
@endsection
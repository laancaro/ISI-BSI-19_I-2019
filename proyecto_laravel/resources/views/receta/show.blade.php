@extends('receta.layout')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Mostrar Recetas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('receta.index') }}"> Atras</a>
            </div>
        </div>
    </div>

    <div class="row">

            <div class="form-group">
                <strong>ID:</strong>
                {{ $receta->id }}
            </div>
        

            <div class="form-group">
                <strong>persona:</strong>
                {{ $receta->persona }}
            </div>   

            <div class="form-group">
                <strong>medicamento:</strong>
                {{ $receta->medicamento }}
            </div>       

            <div class="form-group">
                <strong>cantidad:</strong>
                {{ $receta->cantidad }}
            </div>

            <div class="form-group">
                <strong>usuario:</strong>
                {{ $receta->usuario }}
            </div>

            <div class="form-group">
                <strong>fecha entrega:</strong>
                {{ $receta->fecha_entrega }}
            </div>
      
    </div>
@endsection
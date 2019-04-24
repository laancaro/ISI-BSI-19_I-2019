@extends('medicamento.layout')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Mostrar medicamento</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('medicamento.index') }}"> Atras</a>
            </div>
        </div>
    </div>

    <div class="row">
       
            <div class="form-group">
                <strong>ID:</strong>
                {{ $medicamento->id }}
            </div>
        
            <div class="form-group">
                <strong>nombre:</strong>
                {{ $medicamento->nombre }}
            </div>

            <div class="form-group">
                <strong>descripcion:</strong>
                {{ $medicamento->descripcion }}
            </div>

            <div class="form-group">
                <strong>casa farmaceutica:</strong>
                {{ $medicamento->casa_farmaceutica }}
            </div>
    </div>
@endsection
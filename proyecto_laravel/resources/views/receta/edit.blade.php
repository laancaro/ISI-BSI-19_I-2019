@extends('receta.layout')  
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editor Recetas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('receta.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Los datos ingresados no son los correctos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('receta.update',$receta->id) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
    
                <div class="form-group">
                    <strong>Persona:</strong>
                    <input type="text" name="persona" value="{{ $receta->persona }}" class="form-control" placeholder="persona">
                </div>

                <div class="form-group">
                    <strong>Medicamento:</strong>
                    <input type="text" name="medicamento" value="{{ $receta->medicamento }}" class="form-control" placeholder="medicamento">
                </div>
           
                <div class="form-group">
                    <strong>Cantidad:</strong>
                    <input type="text" name="cantidad" value="{{ $receta->cantidad }}" class="form-control" placeholder="cantidad">
                </div>
 		


                <div class="form-group">
                    <strong>Usuario:</strong>
                    <input type="text" name="usuario" value="{{ $receta->usuario }}" class="form-control" placeholder="usuario">
                </div>



                <div class="form-group">
                    <strong>Fecha Entrega:</strong>
                    <input type="date" name="fecha_entrega" value="{{ $receta->fecha_entrega }}" class="form-control" placeholder="fecha_entrega">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </div>  
    </form>
@endsection
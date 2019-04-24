@extends('medicamento.layout')  
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar medicamento</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('medicamento.index') }}"> Atras</a>
            </div>
        </div>
    </div> 

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong>Tenemos problema con los datos ingresados.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medicamento.update',$medicamento->id) }}" method="POST">
        @csrf
        @method('PUT')   

         <div class="row">
            
                <div class="form-group">
                    <strong>ID:</strong>
                    <input type="text" name="id" value="{{ $medicamento->id }}" class="form-control" placeholder="id">
                </div>
             
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="nombre" value="{{ $medicamento->nombre }}" class="form-control" placeholder="nombre">
                </div>
        </div>
     
                <div class="form-group">
                    <strong>Descripcion:</strong>
                    <input type="text" name="descripcion" value="{{ $medicamento->descripcion }}" class="form-control" placeholder="descripcion">
                </div>

                <div class="form-group">
                    <strong>Casa Farmaceutica:</strong>
                    <input type="text" name="casa_farmaceutica" value="{{ $medicamento->casa_farmaceutica }}" class="form-control" placeholder="casa_farmaceutica">
                </div>            

              <button type="submit" class="btn btn-primary">Aceptar</button>
        </div>
    </form>
@endsection
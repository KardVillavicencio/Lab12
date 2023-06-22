@extends('layouts.app')

@section('content')

<main>
  <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }
    
    @media (min-width:768px){
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
  </style>
  <div class="album py-5 bg-dark">
    <div class="container">
      <form action="{{ route('subirFoto') }}" method="post" enctype="multipart/form-data" class="row g-3">
        @csrf
        <label for="staticEmail2">Subir Una Foto</label>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
          <input type="text" class="form-control" name="descripcion" placeholder="Agrege una descripcion">
        </div>
        <div class="col-auto">
          <input type="file" class="form-control" name="foto">
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary md-3">Subir</button>
        </div>
        
      </form>
      <br/><br/>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($fotos as $foto)
        <div class="col">
          <div class="card shadow-sm">
           <img height="200px" src="{{ asset('storage/fotos/'.$foto->ruta)}}" alt="Imagen" />
            <div class="card-body">
              <p class="card-text">{{$foto->descripcion}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <form method="post" action="{{route('eliminarFoto')}}">
                  @csrf
                  <div class="btn-group">
                    <input type="hidden" name="id_foto" value="{{$foto->id}}">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Eliminar</button>
                  </div>
                </form>
                <small class="text-muted">{{$foto->created_at}}</small>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</main>
@endsection

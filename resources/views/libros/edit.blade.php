@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">

        @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning')}}
        </div>
        @endif

        <div class="col-md-12">
            <div class="pull-right">
                <a class="btn btn-primary shadow-none" data-toggle="tooltip" data-placement="top" title="Inicio" href="{{ route('libros.index') }}">
                    <i class="fa fa-home fa-fw"></i>
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <form  action="{{ route('libros.update', $libro) }}" method="POST" class="row g-3">
              @csrf
              @method('PUT')
              <div class="col-md-6">
                <label for="titulo" class="form-label">Título del Libro</label>
                <input type="text" class="form-control shadow-none shadow-none" id="titulo" name="titulo" value="{{ old('titulo', $libro->titulo) }}">
                @error('titulo')
                    <small class="text-danger" role="alert">
                        {{ $message }}
                    </small>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="idioma" class="form-label">Idioma</label>
                <select id="idioma" class="form-select shadow-none" name="cod_idioma" value="{{ old('cod_idioma') }}">
                  <option value="">Seleccionar...</option>
                  @foreach ($idiomas as $idioma)
                     <option value="{{ $idioma->cod_idioma }}" {{ ($libro->cod_idioma == $idioma->cod_idioma) ? 'selected' : '' }}>{{ $idioma->descripcion }} </option>
                  @endforeach
                </select>
                @error('cod_idioma')
                    <small class="text-danger" role="alert">
                        Seleccione el idioma
                    </small>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="descripcion" class="form-label">Descripción de Libro</label>
                <textarea class="form-control shadow-none" name="descripcion" id="descripcion" cols="30" rows="5" value="">{{ old('descripcion', $libro->descripcion)}}</textarea>
                @error('descripcion')
                    <small class="text-danger" role="alert">
                        {{ $message }}
                    </small>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="fecha_publicacion" class="form-label">Fecha de Publicación</label>
                <input class="form-control shadow-none" type="date" name="fecha_publicacion"  value="{{ old('fecha_publicacion',date("Y-m-d", strtotime($libro->fecha_publicacion))); }}">
                @error('fecha_publicacion')
                    <small class="text-danger" role="alert">
                        {{ $message }}
                    </small>
                @enderror
              </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Actualizar</button>
              </div>
            </form>

        </div>
    </div>
</div>
@endsection

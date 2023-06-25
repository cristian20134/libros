@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success')}}
            </div>
        @endif

        @if (session('primary'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('primary')}}
        </div>
         @endif

         @if (session('danger'))
         <div class="alert alert-primary alert-dismissible fade show" role="alert">
             {{ session('danger')}}
         </div>
          @endif

        <div class="col-md-12 mb-3">
            <div class="pull-right">
                <a class="btn btn-primary shadow-none" data-toggle="tooltip" data-placement="top" title="Agregar Sexo" href="{{ route('sexos.create')}}">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>

        <div class="col-md-12">
            @if(sizeof($sexos) > 0)
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($sexos as $sexo )
                        <tr class="table-secondary">
                            <td scope="row">{{ $sexo->cod_sexo }}</td>
                            <td scope="row">{{ $sexo->descripcion }}</td>
                            <td class="text-center" width="20%">
                                <a href="{{route('sexos.show', $sexo) }}" class="btn btn-primary btn-sm shadow-none"
                                        data-toggle="tooltip" data-placement="top" title="Ver Sexo">
                                    <i class="fa fa-book fa-fw text-white"></i>
                                </a>

                                <a href="{{ route ('sexos.edit', $sexo) }}" class="btn btn-success btn-sm shadow-none"
                                        data-toggle="tooltip" data-placement="top" title="Editar Sexo">
                                    <i class="fa fa-pencil fa-fw text-white"></i>
                                </a>

                                <form action="{{ route('sexos.destroy',$sexo) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete" name="delete" type="submit"
                                            class="btn btn-danger btn-sm shadow-none"
                                            data-toggle="tooltip" data-placement="top" title="Eliminar Sexo"
                                            onclick="return confirm('¿Estás seguro de eliminar?')">
                                        <i class="fa fa-trash-o fa-fw"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class=" d-flex justify-content-center">
                    {{$sexos->links()}}
                </div>
            </div>
            @else
                <div class="alert alert-secondary">No se encontraron resultados.</div>
            @endif
        </div>
    </div>
</div>
@endsection


@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a class="btn btn-primary shadow-none" data-toggle="tooltip" data-placement="top" title="Inicio" href="{{ route('categorias.index') }}">
                    <i class="fa fa-home fa-fw"></i>
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mx-auto" style="width: 50%;">
              <div class="card-header">
                Categoría
              </div>
              <div class="card-body text-center">
                <h5 class="card-title"><b>{{ $categoria->titulo }}</b></h5>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

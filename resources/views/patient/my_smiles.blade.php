@extends('adminlte::page')

@section("title_prefix", "Meus sorrisos")
@section("title")
@section("title_posfix")

@section('content_header')
    <h1 class="m-0 text-dark">Meus Sorrisos</h1>
@stop

@section('content')

    <div class="row text-center">

        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="w-100">Antes</h3>
                    @if ($data["before"])
                        <img src="https://images-cdn.9gag.com/photo/a9ALB5j_700b.jpg" class="img-fluid w-50" alt="Sorriso antes">
                    @else
                        <h6 class="mb-4 text-muted">Imagem não cadastrada</h6>
                        <img src="{{ asset('images/no_image.png') }}" class="img-fluid w-50" alt="Sorriso antes">
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="w-100">Depois</h3>
                    @if ($data["after"])
                        <img src="https://images-cdn.9gag.com/photo/a9ALB5j_700b.jpg" class="img-fluid w-50" alt="Sorriso depois">
                    @else
                        <h6 class="mb-4 text-muted">Imagem não cadastrada</h6>
                        <img src="{{ asset('images/no_image.png') }}" class="img-fluid w-50" alt="Sorriso depois">
                    @endif
                </div>
            </div>
        </div>

    </div>
@stop

@include('patient.footer')

@extends('adminlte::page')

@section("title_prefix", "Início")
@section("title")
@section("title_posfix")

{{-- @section('content_header')
    <h1 class="m-0 text-dark">Início</h1>
@stop --}}

@section('content')
    <div class="row pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Você está conectado!</p>
                </div>
            </div>
        </div>
    </div>
@stop

@include('patient.footer')

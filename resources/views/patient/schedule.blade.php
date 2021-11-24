@extends('adminlte::page')

@section("title_prefix", "Agenda")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Agenda</h1>
@stop

@section('content')
<div class="container-fluid">

    <div class="card h-100 w-100 mb-0">
        <div class="row">
           @foreach ( $appointments as $key => $apt )
                @if ( !empty($apt["date"]))
                    <div class="col-w-75 col-md-8 py-4 px-5 mx-auto">
                        <h6>Data: {{$apt["date"]}}</h6>
                        <h6>Horário: {{$apt["time"]}}</h6>
                    </div>
                    <div class="col py-3 text-center">
                        <button type="submit" class="btn btn-primary btn-oc">Desmarcar</button>
                    </div>
                @else
                    <div class="col-w-75 col-md-8 py-4 px-5 mx-auto">
                        <h4>Você ainda não possui horário marcado.</h4>
                    </div>
                @endif
           @endforeach
        </div>
    </div>

</div>
@stop

@include('patient.footer')

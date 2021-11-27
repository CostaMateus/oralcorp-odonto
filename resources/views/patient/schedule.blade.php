@extends('adminlte::page')

@section("title_prefix", "Agenda")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Agenda</h1>
@stop

@section('content')

    <div class="row">
        @forelse ( $appointments as $key => $apt )
            <div class="col-12 col-sm-4 col-md-3 col-xl-2">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-6 col-sm-12 text-sm-center">
                            <h6                      ><b>Data</b>: {{ $apt["date"] }}</h6>
                            <h6 class="mb-0 mb-sm-3" ><b>Horário</b>: {{ $apt["time"] }}</h6>
                        </div>
                        <div class="col-6 col-sm-12 my-auto my-sm-0 text-sm-center">
                            <button type="submit" class="btn btn-oc float-right float-sm-none">Desmarcar</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col col-md-8 mx-auto p-3">
                <h4>Você ainda não possui horário marcado.</h4>
            </div>
        @endforelse
    </div>

@stop

@include('patient.footer')

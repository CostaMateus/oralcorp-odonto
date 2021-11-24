@extends('adminlte::page')

@section("title_prefix", "Agenda")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Agenda</h1>
@stop

@section('content')

    <div id="card-oc" class="row pt-3">
        <div class="row">
           @foreach ( $appointments as $key => $apt )
                @if ( !empty($apt["date"]))
                <div class="col-12 col-sm-6 col-md-4 col-xl-3 @if($key % 2 ==0)
                bg-light @else bg-dark @endif">
                    <div class="my-auto py-3">
                        <div div class="mx-0 mx-sm-auto text-sm-center float-left float-sm-none">
                            <h6>Data: {{$apt["date"]}}</h6>
                            <h6>Horário: {{$apt["time"]}}</h6>
                        </div>
                        <div class="mx-0 mx-sm-auto text-sm-center float-right float-sm-none">
                            <button type="submit" class="btn btn-primary @if($key % 2 ==0)
                            btn-oc @else btn-light @endif">Desmarcar</button>
                        </div>
                    </div>
                </div>
                @else
                    <div class="col-w-100 col-md-8 py-4 px-5 mx-auto">
                        <h4>Você ainda não possui horário marcado.</h4>
                    </div>
                @endif
           @endforeach
        </div>
    </div>

@stop

@include('patient.footer')

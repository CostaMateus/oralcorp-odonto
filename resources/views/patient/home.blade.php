@extends('adminlte::page')

@section("title_prefix", "Início")
@section("title")
@section("title_posfix")

@section('css')
<style>
    .bg-oc {
        background-color: #3A4762 !important;
    }
</style>
@endsection

@section('preloader')
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('images/logo/logo_b.png') }}" alt="Oral Corp" height="60" width="180">
    </div>
@stop

{{-- @section('content_header')
    <h1 class="m-0 text-dark">Início</h1>
@stop --}}

@section('content')

    <div id="card-oc" class="row pt-3">

        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3">
            <a href="{{ route('patient.treatments') }}">
                <div class="small-box h-100 d-flex bg-oc">
                    <div class="m-auto text-center py-5 px-3 text-white">
                        <h3 class="text-wrap">
                            <i class="nav-icon fas fa-tooth"></i> Nossos tratamentos
                        </h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3">
            <a href="{{ route('patient.contacts') }}">
                <div class="small-box h-100 d-flex bg-light">
                    <div class="m-auto text-center py-5 px-3">
                        <h3 class="text-wrap">
                            <i class="nav-icon fas fa-phone-alt"></i> Nossos contatos
                        </h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3">
            <a href="{{ route('patient.schedule') }}">
                <div class="small-box h-100 d-flex bg-oc">
                    <div class="m-auto text-center py-5 px-3 text-white">
                        <h3 class="text-wrap">
                            <i class="nav-icon fas fa-calendar-day"></i> Agenda
                        </h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3">
            <a href="{{ route('patient.my_smiles') }}">
                <div class="small-box h-100 d-flex bg-light">
                    <div class="m-auto text-center py-5 px-3">
                        <h3 class="text-wrap">
                            <i class="nav-icon fas fa-laugh"></i> Meus sorrisos
                        </h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3">
            <a href="{{ route('patient.financial') }}">
                <div class="small-box h-100 d-flex bg-oc">
                    <div class="m-auto text-center py-5 px-3 text-white">
                        <h3 class="text-wrap">
                            <i class="nav-icon fas fa-dollar-sign"></i> Financeiro
                        </h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3">
            <a href="{{ route('patient.indicate') }}">
                <div class="small-box h-100 d-flex bg-light">
                    <div class="m-auto text-center py-5 px-3">
                        <h3 class="text-wrap">
                            <i class="nav-icon fas fa-comment-dots"></i> Indique um amigo
                        </h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3">
            <a href="{{ route('patient.checkin') }}">
                <div class="small-box h-100 d-flex bg-oc">
                    <div class="m-auto text-center py-5 px-3 text-white">
                        <h3 class="text-wrap">
                            <i class="nav-icon fas fa-map-marker-alt"></i> Check-in
                        </h3>
                    </div>
                </div>
            </a>
        </div>

    </div>

@stop

@include('patient.footer')

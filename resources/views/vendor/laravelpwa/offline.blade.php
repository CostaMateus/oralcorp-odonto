@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section("title_prefix", "Offline")
@section("title")
@section("title_posfix")

@section('adminlte_css')
    <style>
        .alert-danger { color: #721C24 !important; background-color: #F8D7DA !important; border-color: #F5C6CB !important; }
    </style>
@stop

@section('classes_body'){{ 'bg-oc vh-100' }}@stop

@section('body')
    <div class="container d-flex flex-column justify-content-center h-100 w-100">
        <div class="align-content-center">

            {{-- Card Box --}}
            <div class="card col-12 col-sm-10 col-md-5 col-lg-4 mx-auto p-0 {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

                {{-- Card Body --}}
                <div class="rounded-top rounded-bottom card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">

                    {{-- @yield('auth_body') --}}
                    <div class="alert alert-danger mb-0">
                        <h4 class="mb-0" >No momento, você não está conectado a nenhuma rede.</h4>
                    </div>

                </div>

            </div>

        </div>
    </div>
@stop

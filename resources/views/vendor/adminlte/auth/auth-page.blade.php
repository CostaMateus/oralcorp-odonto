@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ 'bg-oc vh-100' }}@stop

@section('body')
    <div class="container d-flex flex-column justify-content-center h-100 w-100">
        <div class="align-content-center">

            {{-- Card Box --}}
            <div class="card col-12 col-sm-10 col-md-5 col-lg-4 mx-auto p-0 {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

                {{-- Card Header --}}
                @hasSection('auth_header')
                    <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                        <h3 class="card-title float-none text-center">
                            @yield('auth_header')
                        </h3>
                    </div>
                @endif

                {{-- Card Body --}}
                <div class="rounded-top card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                    @yield('auth_body')
                </div>

                {{-- Card Footer --}}
                @hasSection('auth_footer')
                    <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                        @yield('auth_footer')
                    </div>
                @endif

            </div>

            @hasSection('footer')
                <div class="col-12 col-sm-10 col-md-5 col-lg-4 mx-auto p-0">
                    @yield('footer')
                </div>
            @endif

        </div>
    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop

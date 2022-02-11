@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('content_top_nav_left')
    <li class="nav-item d-none d-sm-block">
        <a href="/" class="nav-link">Início</a>
    </li>
@stop
@section('content_top_nav_center')
    <li class="nav-item">
        <img class="brand-image d-none d-sm-block" src="{{ asset('images/logo/logo_b.webp') }}" alt="Oral Corp" height="40" >

        <a href="/" class="d-block d-sm-none">
            <img class="brand-image" src="{{ asset('images/logo/logo_b.webp') }}" alt="Oral Corp" height="40" >
        </a>
    </li>
@stop

@section('body')
    <div class="wrapper">
        {{-- Preloader --}}
        @hasSection('preloader')
            @yield('preloader')
        @endif

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop

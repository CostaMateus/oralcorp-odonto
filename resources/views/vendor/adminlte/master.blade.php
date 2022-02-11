<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"                                                      />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"                                                                    />
    <meta name="csrf-token" content="{{ csrf_token() }}"                                                                    />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=5, user-scalable=0" />

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')
    <meta name="keywords" content="Site; Oral Corp; Dentista; Clinicas Odontológicas; Clinicas; Campinas SP, Campinas" />
    <meta name="author"   content="Mateus Costa & Filipe Ferreira"                                                     />

    {{-- Facebook integration --}}
    <meta property="og:title"            content="{{ config('app.name', 'Oral Corp') }}"                />
    <meta property="og:description"      content="{{ config('app.name', 'Oral Corp') }}"                />
    <meta property="og:url"              content="https://app.oralcorp.com.br/"                         />
    <meta property="og:image"            content="https://app.oralcorp.com.br/images/logo/favicon.webp" />
    <meta property="og:image:secure_url" content="https://app.oralcorp.com.br/images/logo/favicon.webp" />
    <meta property="og:image:type"       content="image/webp"                                           />
    <meta property="og:type"             content="website"                                              />
    <meta property="og:locale"           content="pt-BR"                                                />
    <meta property="og:site_name"        content="{{ config('app.name', 'Oral Corp') }}"                />

    {{-- Twitter integration --}}
    <meta name="twitter:title" content="{{ config('app.name', 'Oral Corp') }}"                />
    <meta name="twitter:url"   content="https://app.oralcorp.com.br/"                         />
    <meta name="twitter:image" content="https://app.oralcorp.com.br/images/logo/favicon.webp" />
    <meta name="twitter:card"  content="https://app.oralcorp.com.br/images/logo/favicon.webp" />

    {{-- Title --}}
    <title>
        @yield('title_prefix',  config('adminlte.title_prefix',  ''))
        @yield('title',         config('adminlte.title',        '|'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    <link rel="stylesheet" href="{{ asset('css/oralcorp.css') }}">

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    {{-- PWA --}}
    @laravelPWA
</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Custom Scripts --}}
    @yield('adminlte_js')

</body>

</html>

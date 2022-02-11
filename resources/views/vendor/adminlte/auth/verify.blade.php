@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('meta_tags')
    <meta name="description" content="Verificação de conta | Área de paciente da Oral Corp" />
@stop

@section("title_prefix", "Verificação de conta")
@section("title")
@section("title_posfix")

{{-- @section('auth_header', __('adminlte::adminlte.verify_message')) --}}

@section('auth_body')

    @if(session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('adminlte::adminlte.verify_email_sent') }}
        </div>
    @endif

    {{ __('adminlte::adminlte.verify_check_your_email') }}
    {{ __('adminlte::adminlte.verify_if_not_recieved') }},

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
            {{ __('adminlte::adminlte.verify_request_another') }}
        </button>.
    </form>

@stop

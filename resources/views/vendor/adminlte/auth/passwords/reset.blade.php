@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section("title_prefix", "Trocar senha")
@section("title")
@section("title_posfix")

@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

{{-- @section('auth_header', __('adminlte::adminlte.password_reset_message')) --}}

@section('auth_body')
    <div class="login-logo text-center mb-3">
        <img src="{{ asset("images/logo/logo_b.png") }}" alt="Oral Corp" class="w-100">
    </div>

    <form action="{{ $password_reset_url }}" method="post">
        {{ csrf_field() }}

        {{-- Token field --}}
        <input id="token" type="hidden" name="token" value="{{ $token }}">

        {{-- Email field --}}
        <div class="form-group mb-3">
            <label for="email" >E-mail</label>
            <input id="email" type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="Digite seu e-mail" >

            @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>

        {{-- Password field --}}
        <div class="form-group mb-3">
            <label for="password" >Senha</label>
            <input id="password" type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Digite sua nova senha" >

            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        {{-- Confirm password field --}}
        <div class="form-group mb-3">
            <label for="password_confirmation" >Confirme a senha</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="Digite novamente a senha" >

            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>

        {{-- Confirm password reset button --}}
        <div class="form-group mb-0">
            <button id="btn-submit" type="submit" class="btn btn-oc btn-block ">Trocar senha</button>
        </div>

    </form>
@stop

@section("footer")
    <footer class="py-3 text-center text-white" >
        <p class="h6 mb-0" >&copy; {{ date("Y") }} ORAL CORP ODONTO LTDA – 08.473.814.0001-55. Todos os direitos reservados. Proibida cópia ou reprodução sem autorização.</p>
        <small class="mb-0" >Powered by <a class="text-light" href="https://www.linkedin.com/in/costamateus6/" target="_blank" rel="noopener noreferrer" >Mateus Costa</a></small>
    </footer>
@endsection

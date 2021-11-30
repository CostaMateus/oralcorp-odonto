@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section("title_prefix", "Login")
@section("title")
@section("title_posfix")

{{-- @section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop --}}

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

{{-- @section('auth_header', __('adminlte::adminlte.login_message')) --}}

@section('auth_body')
    <div class="login-logo text-center mb-3">
        <img src="{{ asset("images/logo/logo_b.png") }}" alt="Oral Corp" class="w-100">
    </div>

    @error("status")
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror

    <form id="login-form" action="{{ $login_url }}" method="post">
        {{ csrf_field() }}

        {{-- clinic field --}}
        <div class="form-group mb-3">
            <label for="clinic_id" >Unidade</label>
            <select id="clinic_id" name="clinic_id" class="form-control {{ $errors->has('clinic_id') ? 'is-invalid' : '' }}" >
                <option value="0" selected disabled >Selecione...</option>
                @foreach ($clinics as $c)
                    <option value="{{ $c->id }}" >{{ $c->name }}</option>
                @endforeach
            </select>

            @if($errors->has('clinic_id'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('clinic_id') }}</strong>
                </div>
            @endif
        </div>

        {{-- Email field --}}
        <div class="form-group mb-3">
            <label for="email" >E-mail</label>
            <input id="email" type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="Digite seu e-mail" autofocus>

            @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>

        {{-- Password field --}}
        <div class="form-group mb-3">
            <label for="password" >Senha</label>
            <input id="password" type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Digite sua senha">

            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group mb-0">
            <button id="btn-submit" type="submit" class="btn btn-oc btn-block ">Entrar</button>
        </div>

    </form>
@stop

@section('auth_footer')
    {{-- Register link --}}
    @if($register_url)
        <p class="my-0 float-left">
            <a class="text-oc" href="{{ $register_url }}">Me cadastrar</a>
        </p>
    @endif

    {{-- Password reset link --}}
    @if($password_reset_url)
        <p class="my-0 float-right">
            <a class="text-oc" href="{{ $password_reset_url }}">Esqueci minha senha</a>
        </p>
    @endif
@stop

@section("footer")
    <footer class="py-3 text-center text-white" >
        <p class="h6 mb-0" >&copy; {{ date("Y") }} ORAL CORP ODONTO LTDA – 08.473.814.0001-55. Todos os direitos reservados. Proibida cópia ou reprodução sem autorização.</p>
        <small class="mb-0" >
            Powered by
            <a class="text-light" href="https://www.linkedin.com/in/costamateus6/" target="_blank" rel="noopener noreferrer" >Costa</a>
            &
            <a class="text-light" href="https://www.linkedin.com/in/filipe-lucas/" target="_blank" rel="noopener noreferrer" >Ferreira</a>
        </small>
    </footer>
@endsection

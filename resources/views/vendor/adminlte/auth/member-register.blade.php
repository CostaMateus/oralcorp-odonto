@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('meta_tags')
    <meta name="description" content="Cadastro Membro | Área de paciente da Oral Corp" />
@stop

@section("title_prefix", "Cadastro Membro")
@section("title")
@section("title_posfix")

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

{{-- @section('auth_header', __('adminlte::adminlte.register_message')) --}}

@section('auth_body')
    <div class="login-logo text-center mb-3">
        <img src="{{ asset("images/logo/logo_b.webp") }}" alt="Oral Corp" class="w-75">
    </div>

    <form action="{{ $register_url }}" method="post">
        @csrf

        {{-- member role --}}
        <input type="hidden" name="role" value="{{ $role }}" >

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

        {{-- Name field --}}
        <div class="form-group mb-3">
            <label for="name" >Nome completo</label>
            <input id="name" type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Digite seu nome" autofocus>

            @if($errors->has('name'))
                <div class="invalid-feedback">2
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>

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
            <input id="password" type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Digite sua senha" >

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

        {{-- Register button --}}
        <div class="form-group mb-0">
            <button id="btn-submit" type="submit" class="btn btn-oc btn-block ">Cadastrar</button>
        </div>

    </form>
@stop

@section('auth_footer')
    <p class="my-0 float-left">
        <a class="text-oc" href="{{ $login_url }}">Já sou cadastrado</a>
    </p>
@stop

@section("footer")
    <footer class="pt-3 text-center text-white" >
        <p class="h6 mb-0" >&copy; {{ date("Y") }} ORAL CORP ODONTO LTDA – 08.473.814.0001-55. Todos os direitos reservados. Proibida cópia ou reprodução sem autorização.</p>
        <small class="mb-0" >
            Powered by
            <a class="text-light" href="https://www.linkedin.com/in/costamateus6/" target="_blank" rel="noopener noreferrer" >Costa</a>
            &
            <a class="text-light" href="https://www.linkedin.com/in/filipe-lucas/" target="_blank" rel="noopener noreferrer" >Ferreira</a>
        </small>
    </footer>
@endsection

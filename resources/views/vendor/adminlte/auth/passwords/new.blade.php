@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('meta_tags')
    <meta name="description" content="Redefinição de senha | Área de paciente da Oral Corp" />
@stop

@section("title_prefix", "Redefinição de senha")
@section("title")
@section("title_posfix")

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
@endif

@section('auth_body')
    <div class="login-logo text-center mb-3">
        <img src="{{ asset("images/logo/logo_b.webp") }}" alt="Oral Corp" class="w-75">
    </div>

    @error("status")
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror

    <form id="newpass-form" action="{{ route("save.password") }}" method="post">
        {{ csrf_field() }}

        <input type="hidden" name="external_id" value="{{ session("external_id") }}" >
        <input type="hidden" name="clinic_id"   value="{{ session("clinic_id")   }}" >
        <input type="hidden" name="email"       value="{{ session("email")       }}" >
        <input type="hidden" name="phone"       value="{{ session("phone")       }}" >
        <input type="hidden" name="name"        value="{{ session("name")        }}" >

        <div class="text-center">
            <p>Informe uma nova senha, <br> para completar seu cadastro.</p>
        </div>

        {{-- Password field --}}
        <div class="form-group mb-3">
            <label for="password" >Senha</label>
            <input id="password" type="password" name="password"
                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                value="{{ old('password') }}" placeholder="Digite sua senha" >

            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        {{-- Password confirmation --}}
        <div class="form-group mb-3">
            <label for="password" >Confirmação de senha</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                value="{{ old('password_confirmation') }}" placeholder="Digite novamente a senha" >

            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group mb-0">
            <button id="btn-submit" type="submit" class="btn btn-oc btn-block ">Entrar</button>
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

@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section("title_prefix", "Trocar senha")
@section("title")
@section("title_posfix")

@php( $password_email_url = View::getSection('password_email_url') ?? config('adminlte.password_email_url', 'password/email') )

@if (config('adminlte.use_route_url', false))
    @php( $password_email_url = $password_email_url ? route($password_email_url) : '' )
@else
    @php( $password_email_url = $password_email_url ? url($password_email_url) : '' )
@endif

@section('auth_body')
    <div class="login-logo text-center mb-3">
        <img src="{{ asset("images/logo/logo_b.webp") }}" alt="Oral Corp" class="w-100">
    </div>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @elseif (session('status_error'))
        <div class="alert alert-warning">
            {!! session('status_error') !!}
        </div>
    @endif

    <form action="{{ $password_email_url }}" method="post">
        {{ csrf_field() }}

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

        {{-- Send reset link button --}}
        <div class="form-group mb-0">
            <button id="btn-submit" type="submit" class="btn btn-oc btn-block ">Enviar link de recuperação</button>
        </div>

    </form>
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

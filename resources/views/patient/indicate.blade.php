@extends('adminlte::page')

@section("title_prefix", "Indique")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Sorriso amigo</h1>
@stop

@section('content')

    <div class="card h-100 w-100 mb-0">

        <div class="row">
            <div class="col-12 col-lg-6 py-3 pl-4 pr-3">
                <h5><span class="text-bold">Indicações realizadas:</span>   {{ $indicate["indications_made"]                                }}</h5>
                <h5><span class="text-bold">Descontos concebidos:</span> R$ {{ Helper::number_format($indicate["discounts_received"])       }}</h5>
                <h5><span class="text-bold">Descontos a receber:</span> R$  {{ Helper::number_format($indicate["discounts_to_be_received"]) }}</h5>

                <p class="mb-2" >Quem indica amigo é!</p>
                <p class="mb-2" >Ao indicar um amigo você ganha 20% de desconto na sua próxima mensalidade.</p>
                <p class="mb-2" >Para participar é simples:</p>
                <p class="mb-0" >1) Indique um amigo para fazer uma consulta na cliníca Instituto Oral Corp.</p>
                <p class="mb-0" >2) No ato do cadastramento da primeira consulta na cliníca peça para o seu amigo dizer que você o indicou.</p>
                <p class="mb-2" >3) Você será notificado pelo app que ganhou o desconto, caso o seu amigo inicie o tratamento ortodôntico conosco.</p>
                <p class="mb-0" >Entendeu? Que tal indicar um amigo agora?</p>

                {{-- <button class="btn btn-primary btn-oc" data-toggle="modal" data-target="#modal-default">Indicar</button> --}}
            </div>
            <div class="col-12 col-lg-6 py-3 pr-4 pl-3 text-center d-flex align-items-center">
                <img class="img-fluid w-80" src="{{ asset('images/indique.png') }}" alt="Tratamento">
            </div>
        </div>

    </div>

    {{-- remover qnd resolvido --}}
    <p class="mt-4 mb-0 text-danger" >RPCGetPacienteDesconto</p>
    <p class="mb-0 text-danger" > -> ioc      -> retorna error</p>
    <p class="mb-0 text-danger" > -> aodonto2 -> ok, apenas valores -1</p>
    <p class="mb-0 text-danger" > -> amodonto -> ok, apenas valores -1</p>
@stop

@include('patient.footer')

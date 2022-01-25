@extends('adminlte::page')

@section("title_prefix", "Financeiro")
@section("title")
@section("title_posfix")

@section("css")
    <style>
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
    </style>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Financeiro</h1>
@stop

@section('content')

    <div class="row">

        @forelse ( $financial as $f )

            <div class="col-12 col-sm-4 col-md-3 col-xl-2">
                <div class="card p-3">
                    <div class="text-md-center">
                        <h6 class="mb-2" ><b>Data</b>:     {{ $f["date"]                         }}</h6>
                        <h6 class="mb-0" ><b>Valor</b>: R$ {{ Helper::number_format($f["value"]) }}</h6>
                    </div>
                </div>
            </div>

        @empty

            <div class="col">
                <div class="alert alert-success" role="alert">
                    Sem mensalidades pendentes!
                </div>
            </div>

            <div id="modal-financial" class="modal fade" aria-modal="true" role="dialog" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Sucesso!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4>Você não possui mensalidades pendentes.</h4>
                            <button class="btn btn-oc float-right" data-dismiss="modal" aria-label="Close">OK!</button>
                        </div>
                    </div>
                </div>
            </div>

        @endforelse

    </div>

@stop

@include('patient.footer')

@section('js')
    <script>
        $(document).ready(function() {

            // MODAL-FINANCIAL
            $("#modal-financial").modal("show");

        });
    </script>
@stop

@extends('adminlte::page')

@section("title_prefix", "Financeiro")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Financeiro</h1>
@stop

@section('content')

    <div class="row">
        @forelse ( $financial as $finc )
            <div class="col-12 col-sm-4 col-md-3 col-xl-2">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-6 col-sm-12 text-sm-center">
                            <h6                      ><b>Data   </b>: {{ $finc["date"] }}</h6>
                            <h6 class="mb-0 mb-sm-3" ><b>Valor  </b>: R$ {{ $finc["value"] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div id="modal-financial" class="modal fade show" aria-modal="true" role="dialog" data-backdrop="static">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Sucesso!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body text-right">
                            <h4>Você não possui mensalidades pendentes.</h4>
                            <a href="{{ route('home') }}">
                                <button class="btn btn-primary btn-oc">OK!</button>
                            </a>
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
    // MODAL-FINANCIAL
    $(document).ready(function() {

        $("#modal-financial").modal("show");

    });
</script>
@stop

@extends('adminlte::page')

@section("title_prefix", "Nossos tratamentos")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Nossos Tratamentos</h1>
@stop

@section('content')
    <div class="row">

        @foreach ($treatments as $key => $t)
            <div class="col-12 col-md-6 col-lg-3">
                <a class="treatment" role="button"
                    data-id="{{ $key }}"
                    data-title="{{ $t["title"]}}"
                    data-treatment_description="{{ $t["description"]}}">
                    <div class="small-box bg-white">
                        <div class="inner text-center">
                            <img class="img-circle elevation-2 mb-2" src="{{ asset($t["image"]) }}" width="55" alt="Tratamento">
                            <h4 class="mb-0 text-gray-dark">{{ $t["title"] }}</h4>
                            <span class="btn-link text-oc" >saiba mais</span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>

    <div id="modal-treatment" class="modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="m-title" class="modal-title">{{ $t["title"] }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="m-description" class="modal-body">{{ $t["description"] }}</div>
                <div class="modal-footer float-right">
                    <button type="button" class="btn btn-oc">Tenho interesse</button>
                </div>
            </div>
        </div>
    </div>
@stop

@include('patient.footer')

@section('js')
<script>

    // MODAL-TREATMENT
        $(document).on("click", ".treatment", function() {
            let modal_title   = $(this).data("title");
            let modal_body    = $(this).data("treatment_description");

            $("#m-title").val(modal_title);
            $("#m-description").val(modal_body);

            $("#modal-treatment").modal("show");
        });
</script>
@stop

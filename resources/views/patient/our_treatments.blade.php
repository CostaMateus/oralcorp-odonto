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
                    data-description="{{ $t["description"]}}">
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
                    <h4 id="m-title" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="m-description" class="modal-body"></div>
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
        const title       = $(this).data("title");
        const description = $(this).data("description");

        $("#m-title").html(title);
        $("#m-description").html(description);

        $("#modal-treatment").modal("show");
    });
</script>
@stop

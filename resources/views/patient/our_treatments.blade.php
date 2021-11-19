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
            <div class="col-lg-3 col-12">
                <a class="treatment" href="#" data-id="{{ $key }}">
                    <div class="small-box bg-white">
                        <div class="inner text-center">
                            <img class="img-circle elevation-2 mb-2" src="{{ asset($t["image"]) }}" width="55" alt="Tratamento">
                            <h4 class="mb-0 text-gray-dark">{{ $t["title"] }}</h4>
                            <span class="btn-link">saiba mais</span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>

    <div id="modal-treatment" class="modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="m-title" class="modal-title">asdasd</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="m-description" class="modal-body"></div>
                <div class="modal-footer float-right">
                    <button type="button" class="btn btn-primary btn-ocorp">Tenho interesse</button>
                </div>
            </div>
        </div>
    </div>
@stop

@include('patient.footer')

@section('js')
<script>
    // const treatments = {!! json_encode($treatments) !!};
    // $('#m-title').html(treatments[6]["title"]);
    // $('#modal-treatment').show();
    // console.log(treatments);
</script>
@stop

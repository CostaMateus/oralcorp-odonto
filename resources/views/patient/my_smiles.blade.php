@extends('adminlte::page')

@section('meta_tags')
    <meta name="description" content="Meus sorrisos | Área de paciente da Oral Corp" />
@stop

@section("title_prefix", "Meus sorrisos")
@section("title")
@section("title_posfix")

@section('content_header')
    <h1 class="m-0 text-dark">Meus Sorrisos</h1>
@stop

@section('content')

    <div class="row text-center">

        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="w-100">Antes</h3>
                    @if (!empty($smile["start"]))
                        <a href="#" class="zoom">
                            <img src="{{ $smile["start"] }}" class="img-fluid w-50" alt="Sorriso antes">
                        </a>
                    @else
                        <h6 class="mb-4 text-muted">Imagem não cadastrada</h6>
                        <img src="{{ asset('images/no_image.png') }}" class="img-fluid w-50" alt="Sorriso antes">
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="w-100">Depois</h3>
                    @if (!empty($smile["end"]))
                        <a href="#" class="zoom">
                            <img src="{{ $smile["end"] }}" class="img-fluid w-50" alt="Sorriso depois">
                        </a>
                    @else
                        <h6 class="mb-4 text-muted">Imagem não cadastrada</h6>
                        <img src="{{ asset('images/no_image.png') }}" class="img-fluid w-50" alt="Sorriso depois">
                    @endif
                </div>
            </div>
        </div>

        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" data-dismiss="modal">
                <div class="modal-content" >
                    <div class="modal-body">
                        <img src="" id="imagepreview" class="w-100" >
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop

@include('patient.footer')

@section('js')
    <script>
        $(document).ready(function() {

            $(".zoom").on("click", function() {
                var img = $(this).find("img").attr("src");
                $("#imagepreview").attr("src", img);
                $("#imagemodal").modal("show");
            });

        });
    </script>
@stop

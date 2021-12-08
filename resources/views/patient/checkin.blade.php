@extends('adminlte::page')

@section("title_prefix", "Check-in")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Check-in</h1>
@stop

@section('content')

    <div class="card h-100 w-100 mb-0">

        <div class="row">
            <div class="col-12 py-3 px-4">
                <h5>Faça seu check-in pelo site e evite filas e aglomerações</h5>
                <p>Lembre-se, você precisa estar na clínica para fazer o Check-in</p>
                <button id="make-checkin" type="button" class="btn btn-oc" >Fazer check-in</button>
                <p id="cf-status" class="mt-3 mb-0 d-none" ></p>
            </div>
        </div>

    </div>

    {{-- remover qnd resolvido --}}
    <p class="mt-4 mb-0 text-danger" >RPCGetBT</p>
    <p class="mb-0 text-danger" > -> ioc      -> retorna alguns dados vazios, dps de certa hora para de funcionar</p>
    <p class="mb-0 text-danger" > -> aodonto2 -> não retorna dados</p>
    <p class="mb-0 text-danger" > -> amodonto -> retorna muitos dados repetidos</p>
    <p class="mt-4 mb-0 text-danger" >RPCPutBTSel</p>
    <p class="mb-0 text-danger" > -> ioc      -> retorna error</p>
    <p class="mb-0 text-danger" > -> aodonto2 -> retorna erro muito louco</p> <!-- "error": "{\"name\":\"RequestError\",\"message\":\"Invalid object name '__RBMB_REG_BT'.\",\"code\":\"EREQUEST\",\"number\":208,\"lineNumber\":49,\"state\":1,\"class\":16,\"serverName\":\"SERVIDOR\\\\EDS80\",\"procName\":\"spw_RPCPutBtSel\",\"precedingErrors\":[]}" -->
    <p class="mb-0 text-danger" > -> amodonto -> retorna sucesso no checkin</p>

    <div id="modal-checkin" class="modal fade" aria-modal="true" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modalidade</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Selecione a Modalidade do seu check-in</p>
                    <form id="checkin-form">
                        @csrf
                        @foreach ( $checkins as $c )
                            @if ($c["name"])
                                <div class="form-group my-3">
                                    <div class="form-check" >
                                        <input class="form-check-input" type="radio" name="checkin" id="checkin_id_{{ $c["checkin_id"] }}" value="{{ $c["checkin_id"] }}" required >
                                        <label class="form-check-label" for="checkin_id_{{ $c["checkin_id"] }}">{{ $c["name"] }}</label>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <button id="cf-submit" type="submit" class="btn btn-oc">
                            OK! <i class="ml-2 d-none fas fa-spinner fa-spin text-white"></i>
                        </button>

                        <p id="cf-sending" class="mt-3 mb-0 d-none">Realizando check-in...</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@include('patient.footer')

@section('js')
    <script>
        $(document).ready(function() {

            // MODAL-TREATMENT
            $(document).on("click", "#make-checkin", function() {
                $("#modal-checkin").modal("show");

                $("#cf-sending").addClass("d-none");
                $("#cf-submit").removeClass("disabled").find("i").addClass("d-none");
            });

            // Fazer checkin
            $("#checkin-form").on("submit", function(e) {
                e.preventDefault();

                $("#cf-sending").removeClass("d-none");
                $("#cf-submit").addClass("disabled").find("i").removeClass("d-none");

                $.ajax({
                    type: "POST",
                    url: "{{ route('patient.post.checkin') }}",
                    data: $(this).serialize(),
                    success: function ( data ) {
                        $("#modal-checkin").modal("hide");
                        $("#cf-status").removeClass("d-none").addClass("text-success").html(data.statusText);
                    },
                    error: function ( err ) {
                        console.log( err );

                        $("#modal-checkin").modal("hide");
                        $("#cf-status").removeClass("d-none").addClass("text-danger").html("Ocorreu um erro, tente novamente!");
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@stop

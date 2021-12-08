@extends('adminlte::page')

@section("title_prefix", "Agenda")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Agenda</h1>
@stop

@section('content')

    <div class="row">

        @forelse ( $appointments as $a )

            <div class="col-12 col-sm-4 col-md-3 col-xl-2">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-6 col-sm-12 text-sm-center">
                            <h6                      ><b>Data   </b>: {{ $a["schedule"]["date"] }}</h6>
                            <h6 class="mb-0 mb-sm-3" ><b>Horário</b>: {{ $a["schedule"]["hour"] }}</h6>
                        </div>
                        <div class="col-6 col-sm-12 my-auto my-sm-0 text-sm-center">
                            <button id="cancel-schedule" type="button" class="btn btn-oc float-right float-sm-none"
                                data-id="{{ $a["schedule_id"] }}"
                                data-date="{{ $a["schedule"]["date"] }}"
                                data-hour="{{ $a["schedule"]["hour"] }}"
                            >Desmarcar</button>
                        </div>
                    </div>
                </div>
            </div>

        @empty

            <div class="col col-md-8 mx-auto p-3">
                <h4>Você ainda não possui horário marcado.</h4>
            </div>

        @endforelse

    </div>

    {{-- remover qnd resolvido --}}
    <p class="mt-4 mb-0 text-danger" >RPCGetStatusAgenda</p>
    <p class="mb-0 text-danger"      > - Vai retornar os IDs de todos os status possiveis</p>
    <p class="mt-4 mb-0 text-danger" >RPCPutStatusAgenda</p>
    <p class="mb-0 text-danger"      > - Enviar ID do agendamento e o ID do status</p>
    <p class="mt-4 mb-0 text-danger" >Implamentar essas duas chamadas, assim que o Rogério repassar</p>

    <div id="modal-appointment" class="modal fade" aria-modal="true" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cancelar agendamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="appointment-form" class="text-center" >
                        @csrf
                        <input id="m-id" type="hidden" name="schedule_id">

                        <p class="mb-0" >Deseja realmente cancelar esse agendamento?</p>
                        <p>Dia <span id="m-date" class="text-bold h5" ></span> às <span id="m-hour" class="text-bold h5" ></span></p>

                        <button id="af-submit" type="submit" class="btn btn-danger">
                            Cancelar <i class="ml-2 d-none fas fa-spinner fa-spin text-white"></i>
                        </button>

                        <p id="af-sending" class="mt-3 mb-0 d-none">Cancelando sua consulta...</p>
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
            $(document).on("click", "#cancel-schedule", function() {
                const id   = $(this).data("id");
                const date = $(this).data("date");
                const hour = $(this).data("hour");

                $("#m-id").val(id);
                $("#m-date").html(date);
                $("#m-hour").html(hour);

                $("#modal-appointment").modal("show");
            });

            // Fazer checkin
            $("#appointment-form").on("submit", function(e) {
                e.preventDefault();

                $("#af-sending").removeClass("d-none");
                $("#af-submit").addClass("disabled").find("i").removeClass("d-none");

                // $.ajax({
                //     type: "POST",
                //     url: "{{ route('patient.post.checkin') }}",
                //     data: $(this).serialize(),
                //     success: function ( data ) {
                //         $("#modal-checkin").modal("hide");
                //         $("#cf-status").removeClass("d-none").addClass("text-success").html(data.statusText);
                //     },
                //     error: function ( err ) {
                //         console.log( err );
                //         $("#modal-checkin").modal("hide");
                //         $("#cf-status").removeClass("d-none").addClass("text-danger").html("Ocorreu um erro, tente novamente!");
                //         window.location.reload();
                //     }
                // });
            });
        });
    </script>
@stop

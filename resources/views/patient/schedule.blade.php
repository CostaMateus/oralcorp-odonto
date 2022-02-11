@extends('adminlte::page')

@section('meta_tags')
    <meta name="description" content="Agenda | Área de paciente da Oral Corp" />
@stop

@section("title_prefix", "Agenda")
@section("title")
@section("title_posfix")

@section('css')
<style>
    .fs-12 {
        font-size: 12px;
    }
    .btn-check:active+.btn-outline-oc,
    .btn-check:checked+.btn-outline-oc,
    .btn-outline-oc.active,
    .btn-outline-oc.dropdown-toggle.show,
    .btn-outline-oc:active {
        color: #FFF !important;
        background-color: #0a1a3b !important;
        border-color: #0a1a3b !important;
    }
    .btn-outline-oc {
        color: #0a1a3b !important;
        background-color: #FFF !important;
        border-color: #0a1a3b !important;
    }
    .btn-oc {
        color: #FFF !important;
        background-color: #0a1a3b !important;
    }
    .text-oc {
        color: #0a1a3b;
    }

    .text-decoration-line-through {
        text-decoration: line-through!important;
    }
    #div-schedule [type='radio'] {
        display: none;
    }
    .btn-check:disabled+.btn, .btn-check[disabled]+.btn {
        pointer-events: none;
        filter: none;
        opacity: .65;
    }
    .border-t {
        border-color: transparent !important;
    }
    /*
        .spin-load {
            width: 45px;
            height: 45px;
            margin: auto 5px;
            border: 3px solid #F2F2F2;
            border-top: 3px solid #AEAEAE;
            border-radius: 50%;
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
        }
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        #modalEnd h5, #div-header-schedule h5 {
            font-family: "Open Sans", sans-serif !important;
            font-size: 21px;
        }
*/
        @media (max-width: 375px) {
            #ocCarousel .btn {
                padding: .375rem .5rem !important;
            }
        }
</style>
@stop

@section('content_header')
    <div class="row">
        <div class="col-6">
            <h1 class="m-0 text-dark">Agenda</h1>
        </div>
        <div class="col-6 text-right d-block d-sm-none">
            <button class="btn btn-info" data-toggle="modal" data-target="#modal-new-appointment" >Agendar consulta</button>
        </div>
    </div>
@stop

@section('content')

    <div class="row">
        <div class="col-12 pb-3 d-none d-sm-block">
            <button class="btn btn-info" data-toggle="modal" data-target="#modal-new-appointment" >Agendar consulta</button>
        </div>

        @forelse ( $appointments as $a )

            <div class="col-12 col-sm-4 col-md-3 col-xl-2">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-6 col-sm-12 text-sm-center">
                            <h6                      ><b>Data   </b>: {{ $a["schedule"]["date"] }}</h6>
                            <h6 class="mb-0 mb-sm-3" ><b>Horário</b>: {{ $a["schedule"]["hour"] }}</h6>
                        </div>
                        <div class="col-6 col-sm-12 my-auto my-sm-0 text-sm-center">
                            <button type="button" class="btn btn-danger float-right float-sm-none cancel-schedule"
                                data-id="{{ $a["schedule_id"] }}"
                                data-date="{{ $a["schedule"]["date"] }}"
                                data-hour="{{ $a["schedule"]["hour"] }}"
                            >Desmarcar</button>
                        </div>
                    </div>
                </div>
            </div>

        @empty

            <div class="col col-md-8 mx-auto p-3 text-center">
                <h4>Você ainda não possui horário marcado.</h4>
            </div>

        @endforelse

    </div>


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
                        <p>
                            Dia <span id="m-date" class="text-bold h5" ></span>
                            <br>
                            Às <span id="m-hour" class="text-bold h5" ></span>
                        </p>

                        <button id="af-submit" type="submit" class="btn btn-danger">
                            Confirmar cancelamento <i class="ml-2 d-none fas fa-spinner fa-spin text-white"></i>
                        </button>

                        <p id="af-sending" class="mt-3 mb-0 d-none">Cancelando sua consulta...</p>
                        <p id="af-reload" class="mt-2 mb-0 d-none">A página recarregará automaticamente.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-new-appointment" class="modal modal-fullscreen-lg fade" aria-modal="true" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Novo agendamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="new-appointment-form" class="text-center" >
                        @csrf
                        <div id="naf-main" class="row">
                            <div class="col-12 col-md-6">
                                @if (is_null(auth()->user()->phone))
                                    <div class="form-group col-8 mx-auto mb-3">
                                        <label for="phone" class="form-label">Telefone *</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="(00) 00000-0000" required >
                                    </div>
                                @endif
                                <div class="form-group col-8 mx-auto mb-3">
                                    <label for="reason" class="form-label">Motivo do agendamento *</label>
                                    <textarea class="form-control" id="reason" name="reason" rows="2" required ></textarea>
                                </div>
                                <div class="form-group col-8 mx-auto mb-3">
                                    <span class="form-text h6" style="font-size: 0.75rem">
                                        * Campos obrigatórios
                                    </span>
                                </div>
                            </div>

                            <div class="col-10 col-md-6 mt-md-0 mx-auto text-center">
                                <div id="div-header-schedule" class="row">
                                    <div class="col-12 d-flex justify-content-between mb-2">
                                        <button class="btn btn-oc" type="button" data-target="#ocCarousel" data-slide="prev">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <h5 class="my-2">Horários</h5>
                                        <button class="btn btn-oc" type="button" data-target="#ocCarousel" data-slide="next">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>

                                <div id="div-schedule" class="row">
                                    <div id="ocCarousel" class="carousel slide" data-interval="0" data-pause="true" data-wrap="true">
                                        <div class="carousel-inner px-1">
                                            <div class="carousel-item active">
                                                <div class="row">

                                                    @foreach ($schedules as $key => $sch)

                                                        <div class="col-3">
                                                            <div class="row">
                                                                <div class="col-12 fw-bold">
                                                                    <p class="mb-1">
                                                                        {{ $sch["day"] }}
                                                                        <br>
                                                                        <span class="text-muted fs-12">{{ $sch["dayFormatted"] }}</span>
                                                                    </p>
                                                                </div>

                                                                @foreach (Helper::getConstHours() as $constHour)
                                                                    @php
                                                                        $id = Helper::makeIdSchedule($sch["date"], $constHour);

                                                                        if ($sch["dayWeek"] == "Sáb" || $sch["dayWeek"] == "Dom")
                                                                        {
                                                                            // Não exibe texto/horario, se for sabado ou domingo
                                                                            $disb  = "disabled";
                                                                            $class = "btn-outline-secondary border-t";
                                                                            $text  = "-";
                                                                        }
                                                                        else if (in_array($constHour, $sch["hours"]) )
                                                                        {
                                                                            if ($sch["day"] == "Hoje" && $constHour <= date("H:i"))
                                                                            {
                                                                                // Se for o dia corrente e o horário já tiver passado, fica bloqueado
                                                                                $disb  = "disabled";
                                                                                $class = "btn-outline-secondary text-decoration-line-through";
                                                                            }
                                                                            else
                                                                            {
                                                                                // Horarios disponiveis
                                                                                $disb  = "";
                                                                                $class = "btn-outline-oc";
                                                                            }

                                                                            $text = $constHour;
                                                                        }
                                                                        else
                                                                        {
                                                                            // Horarios indisponiveis
                                                                            $disb  = "disabled";
                                                                            $class = "btn-outline-secondary text-decoration-line-through";
                                                                            $text  = $constHour;
                                                                        }
                                                                    @endphp

                                                                    <div class="col-12 my-1">
                                                                        <input class="btn-check" id="{{ $id }}" type="radio" name="hour" value="{{ $id }}" autocomplete="off" {{ $disb }}>
                                                                        <label class="btn {{ $class }}" for="{{ $id }}">{{ $text }}</label>
                                                                    </div>

                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        @if ($loop->iteration % 4 == 0 && $loop->iteration < config("personaleasy.scheduleDays"))
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="row">
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="error_hour" class="mx-auto text-center my-3 d-none">
                                        <span class="h6 text-danger">
                                            Selecione um horário
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button id="naf-submit" type="submit" class="btn btn-oc my-2">
                            Confirmar agendamento
                        </button>

                        <p id="naf-sending" class="d-none">
                            Agendando sua consulta <i class="ml-2 fas fa-spinner fa-spin"></i>
                        </p>
                        <p id="naf-reload" class="mb-0 d-none">
                            A página recarregará automaticamente.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@include('patient.footer')


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var maskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            }, options = {onKeyPress: function(val, e, field, options) {
                field.mask(maskBehavior.apply({}, arguments), options);
            }};
            $('#phone').mask(maskBehavior, options);

            // MODAL-APPOINTMENT
            $(document).on("click", ".cancel-schedule", function() {
                const id   = $(this).data("id") ? $(this).data("id") : 111111111;
                const date = $(this).data("date");
                const hour = $(this).data("hour");

                $("#m-id").val(id);
                $("#m-date").html(date);
                $("#m-hour").html(hour);

                $("#modal-appointment").modal("show");
            });

            // Cancelar agendamento
            $("#appointment-form").on("submit", function(e) {
                e.preventDefault();

                $("#af-sending").removeClass("d-none");
                $("#af-submit").addClass("disabled").find("i").removeClass("d-none");

                $.ajax({
                    type: "POST",
                    url: "{{ route('patient.cancel.schedule') }}",
                    data: $(this).serialize(),
                    success: function ( data ) {
                        console.log(data);

                        let msg = "";
                        let cls = "";

                        if (data.code == 200)
                        {
                            msg = data.statusText;
                            cls = "text-success";
                        }
                        else
                        {
                            msg = "Ocorreu um erro, tente novamente!";
                            cls = "text-danger";
                        }

                        $("#af-sending").removeClass("d-none").addClass(cls).html(msg);
                    },
                    error: function ( err ) {
                        $("#af-sending").removeClass("d-none").addClass("text-danger").html("Ocorreu um erro, tente novamente!");
                    },
                    complete: function( data ) {
                        // console.log(data);
                        $("#af-reload").removeClass("d-none");

                        setTimeout(function() {
                            window.location.reload();
                        }, 3500);
                    }
                });
            });

            $("#new-appointment-form").on("submit", function(e) {
                e.preventDefault();

                $("#error_hour").addClass("d-none");

                $("#naf-main").addClass("d-none");
                $("#naf-submit").addClass("d-none");
                $("#naf-sending").removeClass("d-none");

                if (!$("input[name=hour]:checked", "#new-appointment-form").val())
                {
                    $("#error_hour").removeClass("d-none");
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('patient.create.schedule') }}",
                    data: $(this).serialize(),
                    success: function ( data ) {
                        console.log( data );

                        let msg = data.statusText;
                        let cls = (data.code == 200) ? "text-success" : "text-danger";

                        $("#naf-sending").addClass(cls).html(msg);
                    },
                    error: function ( err ) {
                        console.log( err );
                        $("#naf-sending").addClass("text-danger").html("Ocorreu um erro, tente novamente!");
                    },
                    complete: function( data ) {
                        // console.log(data);
                        $("#naf-reload").removeClass("d-none");

                        setTimeout(function() {
                            window.location.reload();
                        }, 3500);
                    }
                });

            });

        });
    </script>
@stop

@extends('adminlte::page')

@section("title_prefix", "Contatos")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Contatos</h1>
@stop

@section('content')

    <div class="card h-100 w-100 mb-0">

        <div class="row">
            <div class="col-12 col-lg-6 py-3 pl-4 pr-3">
                <h5>Entre em contato conosco, agende sua avaliação e confira tudo o que podemos oferecer a você.</h5>

                <form id="contact-form">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Sua mensagem"></textarea>
                    </div>
                    <button id="cf-submit" type="submit" class="btn btn-primary btn-oc">
                        Enviar <i class="ml-2 d-none fas fa-spinner fa-spin text-white"></i>
                    </button>

                    <p id="cf-sending" class="mt-3 mb-0 d-none">Enviando mensagem...</p>
                </form>

                <p id="cf-status" class="mt-3 mb-0 d-none" ></p>
            </div>

            <div class="col-12 col-lg-6 py-3 pr-4 pl-3">
                <h5>{{ auth()->user()->clinic->full_name }}</h5>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td style="width: 5%" class="text-center">
                                <i class="nav-icon fas fa-phone-alt"></i>
                            </td>
                            <td>{{ auth()->user()->clinic->phone }}</td>
                        </tr>
                        <tr>
                            <td style="width: 5%" class="text-center" widht="10px">
                                <i class="nav-icon fab fa-whatsapp"></i>
                            </td>
                            <td>
                                <a class="text-dark" href="https://wa.me/+55{{ preg_replace("/\D+/", "", auth()->user()->clinic->whatsapp) }}" target="_blank">{{ auth()->user()->clinic->whatsapp }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 5%" class="text-center" widht="10px">
                                <i class="nav-icon fab fa-instagram"></i>
                            </td>
                            <td>
                                <a class="text-dark" href="https://www.instagram.com/{{ auth()->user()->clinic->instagram }}" target="_blank">{{ auth()->user()->clinic->instagram }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 5%" class="text-center" widht="10px">
                                <i class="nav-icon fas fa-globe"></i>
                            </td>
                            <td>
                                <a class="text-dark" href="http://www.oralcorp.com.br" target="_blank">Oral Corp</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 5%" class="text-center" widht="10px">
                                <i class="nav-icon fas fa-map-marker-alt"></i>
                            </td>
                            <td>{{ auth()->user()->clinic->address }}</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </div>

@stop

@include('patient.footer')

@section('js')
    <script>
        let treatment = "{{ $treatment }}";

        if (treatment) $("#contact-form #message").val("Tenho interesse em " + treatment + ".\nGostaria de maiores detalhes.");

        $(document).ready(function() {

            $("#cf-sending").addClass("d-none");

            $("#contact-form").on("submit", function(e) {
                e.preventDefault();

                $("#cf-sending").removeClass("d-none");
                $("#cf-submit").addClass("disabled").find("i").removeClass("d-none");

                $.ajax({
                    type: "POST",
                    url: "{{ route('patient.send.message') }}",
                    data: $(this).serialize(),
                    success: function ( data ) {
                        $("#cf-status").removeClass("d-none").addClass("text-success").html(data.statusText);
                        $("#cf-sending").addClass("d-none");
                        $("#cf-submit").removeClass("disabled").find("i").addClass("d-none");
                        $("#contact-form #message").val("");
                        setTimeout(function () { window.location.href = "{{ route('patient.contacts') }}" }, 1500);
                    },
                    error: function ( err ) {
                        console.log( err );

                        $("#cf-status").removeClass("d-none").addClass("text-danger").html("Ocorreu um erro, tente novamente!");
                        $("#cf-sending").addClass("d-none");
                        $("#cf-submit").removeClass("disabled").find("i").addClass("d-none");
                        // window.location.reload();
                        // setTimeout(function () { window.location.reload() }, 1500);
                    }
                });
            });

        });
    </script>
@stop

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

                <form action="ainda a definir" method="post" wtx-context="F6252596-09B9-46BE-8966-73F21620E9CF">
                    <div class="form-group">
                        <textarea class="form-control" id="message" rows="5" placeholder="Sua mensagem"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-oc">Enviar</button>
                </form>
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

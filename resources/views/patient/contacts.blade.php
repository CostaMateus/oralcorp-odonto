@extends('adminlte::page')

@section("title_prefix", "Contatos")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Contatos</h1>
@stop

@section('content')
<div class="container-fluid pb-3">

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
          <h5>Outros contatos</h5>
          <table class="table table-sm table-borderless">
            <tbody>
              <tr>
                <td style="width: 5%" class="text-center">
                  <i class="nav-icon fas fa-phone-alt"></i>
                </td>
                <td>
                    {{ $data["number_phone"] }}
                </td>
              </tr>
              <tr>
                <td style="width: 5%" class="text-center" widht="10px">
                  <i class="nav-icon fab fa-whatsapp"></i>
                </td>
                <td>
                    <a class="text-dark" href="https://wa.me/+5519974170441" target="_blank">{{ $data["whatsapp_phone"] }}</a>
                </td>
              </tr>
              <tr>
                <td style="width: 5%" class="text-center" widht="10px">
                  <i class="nav-icon fab fa-facebook-f"></i>
                </td>
                <td>
                  <a class="text-dark" href="https://www.facebook.com/iocodontologia" target="_blank">{{ $data["facebook"] }}</a>
                </td>
              </tr>
              <tr>
                <td style="width: 5%" class="text-center" widht="10px">
                  <i class="nav-icon fab fa-instagram"></i>
                </td>
                <td>
                  <a class="text-dark" href="https://www.instagram.com/p/CEUMqpnHD-e/" target="_blank">{{ $data["instagram"] }}</a>
                </td>
              </tr>
              <tr>
                <td style="width: 5%" class="text-center" widht="10px">
                  <i class="nav-icon fas fa-globe-americas"></i>
                </td>
                <td>
                  <a class="text-dark" href="http://www.oralcorp.com.br" target="_blank">{{ $data["site"] }}</a>
                </td>
              </tr>
              <tr>
                <td style="width: 5%" class="text-center" widht="10px">
                  <i class="nav-icon fas fa-map-marker-alt"></i>
                </td>
                <td>
                  <a class="text-dark" href="https://www.google.com.br/maps/dir//Oral+Corp+-+Clinicas+Odontol%C3%B3gicas+-+Av.+Francisco+Glic%C3%A9rio,+669+-+Vila+Lidia,+Campinas+-+SP,+13012-100/@-22.9084193,-47.0580352,19.5z/data=!4m8!4m7!1m0!1m5!1m1!1s0x94c8cf4aab92abf7:0x17106f66f110b3bd!2m2!1d-47.058033!2d-22.9085498" target="_blank">
                        {{ $data["location"] }}</a>
                </td>
               </tr>
            </tbody>

        </table>
        </div>
      </div>
    </div>

</div>
@stop

@include('patient.footer')

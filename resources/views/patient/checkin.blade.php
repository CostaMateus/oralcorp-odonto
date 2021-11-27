@extends('adminlte::page')

@section("title_prefix", "Check-in")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Check-in</h1>
@stop

@section('content')
    <div class="container-fluid">

        <div class="card h-100 w-100 mb-0">
            <div class="row">
            <div class="col-12 py-3 px-4">
                <h5>Faça seu Check-in pelo site e evite filas e aglomerações</h5>
                <p>Lembre-se, você precisa estar na clínica para fazer o Check-in</p>
                <button type="submit" class="btn btn-primary btn-oc" data-toggle="modal" data-target="#modal-default">Fazer check</button>
            </div>
            </div>
        </div>

    </div>

    <div id="modal-checkin" class="modal fade show" aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Modalidade</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Selecione a Modalidade do seu Check-in</p>
              <form action="a definir" method="post">
                  @foreach ( $checkins as $key => $c )
                    <div class="form-group my-3">
                        <div class="form-check" >
                            <input class="form-check-input" type="radio" name="exampleRadios" id="{{ $key }}" value="1">
                            <label class="form-check-label" for="{{ $key }}">
                                {{ $c["title"] }}
                            </label>
                        </div>
                    </div>
                   @endforeach
                <button type="submit" class="btn btn-primary btn-oc">OK!</button>
              </form>
            </div>
          </div>
        </div>
      </div>

@stop

@include('patient.footer')

@section('js')
<script>
    // MODAL-TREATMENT
    $(document).on("click", ".btn", function() {

        $("#modal-checkin").modal("show");

    });
</script>
@stop

@extends('adminlte::page')

@section("title_prefix", "Contatos")
@section("title")
@section("title_posfix")


@section('content_header')
    <h1 class="m-0 text-dark">Contatos</h1>
@stop

@section('content')
<div class="container-fluid">

    <div class="card h-100 w-100 mb-0">
        <div class="row">
            <div class="col-w-75 col-md-8 py-4 px-5 mx-auto" class="schedule-table">
              <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100 " src="https://media-cdn.tripadvisor.com/media/photo-s/01/4f/2d/ac/bonita-springs.jpg" alt="Primeiro Slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://media-cdn.tripadvisor.com/media/photo-s/01/4f/2d/ac/bonita-springs.jpg" alt="Segundo Slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://media-cdn.tripadvisor.com/media/photo-s/01/4f/2d/ac/bonita-springs.jpg" alt="Terceiro Slide">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                  </a>
              </div>
            </div>
        </div>
        <div class="col py-3 text-center">
            <h6>Agora é só confirmar e marcar sua consulta.</h6>
            <button type="submit" class="btn btn-primary btn-oc">Marcar</button>
        </div>
    </div>

</div>
@stop

@include('patient.footer')

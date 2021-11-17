@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Nossos Tratamentos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-12">
            <a href="#" data-toggle="modal" data-target="#modal-default">
                <div class="small-box bg-white">
                    <div class="inner text-center">
                        <img class="img-circle elevation-2 mb-2" src="{{asset('images/home/s.png')}}" width="35" alt="Tratamento">
                        <h4 class="mb-0 text-gray-dark">Cirurgia</h4>
                        <span class="btn-link">saiba mais</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="modal fade show" id="modal-default" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Título</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
              <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
            <div class="modal-footer float-right">
              <button type="button" class="btn btn-primary btn-ocorp">Tenho interesse</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@stop

@extends('adminlte::page')

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
                    @if (!empty($smile[0][0]["data"]))
                        <a href="#" class="zoom">
                            <!--<img src="$smile[0][0]["data"]" class="img-fluid w-50" alt="Sorriso depois">-->
                            <img src="https://images-cdn.9gag.com/photo/a9ALB5j_700b.jpg" class="img-fluid w-50" alt="Sorriso antes">
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
                    @if (!empty($smile[1][0]["data"]))
                        <a href="#" class="zoom">
                            <!--<img src="$smile[1][0]["data"]" class="img-fluid w-50" alt="Sorriso depois">-->
                            <img src="https://www.42frases.com.br/wp-content/uploads/2018/10/frases-dr-house.jpg" class="img-fluid w-50" alt="Sorriso depois">
                        </a>
                    @else
                        <h6 class="mb-4 text-muted">Imagem não cadastrada</h6>
                        <img src="{{ asset('images/no_image.png') }}" class="img-fluid w-50" alt="Sorriso depois">
                    @endif
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" data-dismiss="modal">
              <div class="modal-content"  >
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                    <img src="" class="imagepreview" style="width: 100%;" >
                </div>
              </div>
            </div>
          </div>

    </div>
@stop

@section('js')
<script>
    $(function() {
        $('.zoom').on('click', function() {
            $('.imagepreview').attr('src', $(this).find('img').attr('src'));
            $('#imagemodal').modal('show');
        });
    });
</script>
@stop

@include('patient.footer')

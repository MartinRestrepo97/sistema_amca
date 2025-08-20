
@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Catálogo</div>

                <div class="card-body">
                    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active" data-interval="10000">
                            <img src="https://previews.123rf.com/images/fotomandm/fotomandm1511/fotomandm151100154/48089736-campo-agr%C3%ADcola-con-una-casa-en-el-fondo.jpg" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item" data-interval="2000">
                            <img src="https://static.iris.net.co/semana/upload/images/2020/7/10/685756_1.jpg" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="https://www.greenappsandweb.com/wp-content/uploads/2015/08/Agroptima-app.jpg" class="d-block w-100" alt="...">
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection


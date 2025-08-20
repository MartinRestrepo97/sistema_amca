
@extends('layouts.app_home')


@section('content')

<!--CARRUCEL DE IMAGENES-->

<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/animales/vacas-fooster.jpg" class="d-block w-100" style="max-height: 395px;" alt="">
      <div class="carousel-caption d-none d-md-block">
        <h1 style="font-size: 101px;">First slide label</h1>
        <p style="font-size: 21px;">Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/vegetales/aguacate-silvestre.jpg" class="d-block w-100" style="max-height: 395px;" alt="">
      <div class="carousel-caption d-none d-md-block">
        <h1 style="font-size: 101px;">Second slide label</h1>
        <p style="font-size: 21px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/preparados/embuelto-choclos.jpg" class="d-block w-100" style="max-height: 395px;" alt="">
      <div class="carousel-caption d-none d-md-block">
        <h1 style="font-size: 101px;">Third slide label</h1>
        <p style="font-size: 21px;">Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/finca/finca8.jpg" class="d-block w-100" style="max-height: 395px;" alt="">
      <div class="carousel-caption d-none d-md-block">
        <h1 style="font-size: 101px;">Third slide label</h1>
        <p style="font-size: 21px;">Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/agricultores/agricultor8.jpg" class="d-block w-100" style="max-height: 395px;" alt="">
      <div class="carousel-caption d-none d-md-block">
        <h1 style="font-size: 101px;">Third slide label</h1>
        <p style="font-size: 21px;">Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

@php //echo "<pre>"; print_r($animales); echo "</pre>";
@endphp
<!--/CARRUCEL DE IMAGENES-->

<!---TITULOS VEGETALES-->
<div class="container">
    <div class="row">
      <div class="col text-center text-uppercase">
        <small>Conoce nuetros</small>
        <h2>VEGETALES</h2>
      </div>
    </div>
</div>
<!---/TITULOS-->

<!--CARRUCEL CARDS-->
<div class="container">
  <div class="row">
    @php $cont=1; @endphp
    @foreach($vegetales as $veg)      
        <div class="col-md-3 " style="float:left">            
            <div class="card mb-2">
              <a href="pagina_detalle/{{$veg->id}}/vegetal" style="text-decoration: none;color: white;">
                <img class="card-img-top mb-2"                  
                src="img/vegetales/{{$veg->imagen}}" alt="Card image cap">
              </a>
              <div class="card-body  bg-secondary text-decoration-none" style="max-height: 9em; min-height: 9em; overflow-y: hidden;">
                <a href="pagina_detalle/{{$veg->id}}/vegetal" style="text-decoration: none;color: white;">
                  <h4 class="card-title text-decoration-none"><b>{{$veg->especie}}</b></h4>
                  <p class="card-text text-decoration-none">{{$veg->observaciones}}</p>                  
                </a>
              </div>              
            </div>         
        </div>      
      @php $cont++; @endphp
    @endforeach
  </div>
</div>

<!--/CARRUCEL CARDS-->

<!---TITULOS 2 ANIMALES-->
<div class="container">
    <div class="row">
      <div class="col text-center text-uppercase">
        <small>Conoce nuetros</small>
        <h2>ANIMALES</h2>
      </div>
    </div>
</div>
<!---/TITULOS 2-->

<!--CARRUCEL CARDS 2 ANIMALES-->
<div class="container">
  <div class="row">
    @php $cont=1; @endphp
    @foreach($animales as $anm)      
        <div class="col-md-3 " style="float:left">            
            <div class="card mb-2">
              <a href="pagina_detalle/{{$anm->id}}/animal" style="text-decoration: none;color: white;">
                <img class="card-img-top mb-2"                  
                src="img/animales/{{$anm->imagen}}" alt="Card image cap">
              </a>
              <div class="card-body  bg-secondary text-decoration-none" style="max-height: 9em; min-height: 9em; overflow-y: hidden;">
                <a href="pagina_detalle/{{$anm->id}}/vegetal" style="text-decoration: none;color: white;">
                  <h4 class="card-title text-decoration-none"><b>{{$anm->especie}}</b></h4>
                  <p class="card-text text-decoration-none">{{$anm->observaciones}}</p>                  
                </a>
              </div>              
            </div>         
        </div>      
      @php $cont++; @endphp
    @endforeach
  </div>
</div>
<!--/CARRUCEL CARDS 2--> 

<!---TITULOS 3 PREPARADOS-->
<div class="container">
    <div class="row">
      <div class="col text-center text-uppercase">
        <small>Conoce nuetros</small>
        <h2>PREPARADOS</h2>
      </div>
    </div>
</div>
<!---/TITULOS 3-->

<!--CARRUCEL CARDS 3-->
<div class="container">
  <div class="row">
    @php $cont=1; @endphp
    @foreach($preparados as $pre)      
        <div class="col-md-3 " style="float:left">            
            <div class="card mb-2">
              <a href="pagina_detalle/{{$pre->id}}/preparado" style="text-decoration: none;color: white;">
                <img class="card-img-top mb-2"                  
                src="img/preparados/{{$pre->imagen}}" alt="Card image cap">
              </a>
              <div class="card-body  bg-secondary text-decoration-none" style="max-height: 9em; min-height: 9em; overflow-y: hidden;">
                <a href="pagina_detalle/{{$pre->id}}/preparado" style="text-decoration: none;color: white;">
                  <h4 class="card-title text-decoration-none"><b>{{$pre->nombre}}</b></h4>
                  <p class="card-text text-decoration-none">{{$pre->observaciones}}</p>                  
                </a>
              </div>              
            </div>         
        </div>      
      @php $cont++; @endphp
    @endforeach
  </div>
</div>
<!--/CARRUCEL CARDS 3-->

<!---TITULOS 4 AGRICULTORES-->
<div class="container">
  <div class="row">
    <div class="col text-center text-uppercase">
      <small>Conoce nuetros</small>
      <h2>AGRICULTORES</h2>
    </div>
  </div>
</div>
<!---/TITULOS 4-->

<!--CARRUCEL CARDS 4-->
<div class="container">
  <div class="row">
    @php $cont=1; @endphp
    @foreach($agricultores as $agr)      
        <div class="col-md-3 " style="float:left">            
            <div class="card mb-2">
              <a href="pagina_detalle/{{$agr->id}}/agricultor" style="text-decoration: none;color: white;">
                <img class="card-img-top mb-2"                  
                src="img/agricultores/{{$agr->imagen}}" alt="Card image cap">
              </a>
              <div class="card-body  bg-secondary text-decoration-none" style="max-height: 9em; min-height: 9em; overflow-y: hidden;">
                <a href="pagina_detalle/{{$agr->id}}/agicultores" style="text-decoration: none;color: white;">
                  <h4 class="card-title text-decoration-none"><b>{{$agr->nombres}}</b></h4>
                  <p class="card-text text-decoration-none">{{$agr->telefono}}</p>                  
                </a>
              </div>              
            </div>         
        </div>      
      @php $cont++; @endphp
    @endforeach
  </div>
</div>
<!--/CARRUCEL CARDS 4-->

<!---TITULOS 5 FINCAS-->
<div class="container">
  <div class="row">
    <div class="col text-center text-uppercase">
      <small>Conoce nuetras</small>
      <h2>FINCAS</h2>
    </div>
  </div>
</div>
<!---/TITULOS 5-->

<!--CARRUCEL CARDS 5-->
<div class="container">
  <div class="row">
    @php $cont=1; @endphp
    @foreach($fincas as $fin)      
        <div class="col-md-3 " style="float:left">            
            <div class="card mb-2">
              <a href="pagina_detalle/{{$fin->id}}/finca" style="text-decoration: none;color: white;">
                <img class="card-img-top mb-2"                  
                src="img/finca
                /{{$fin->imagen}}" alt="Card image cap">
              </a>
              <div class="card-body  bg-secondary text-decoration-none" style="max-height: 9em; min-height: 9em; overflow-y: hidden;">
                <a href="pagina_detalle/{{$fin->id}}/finca" style="text-decoration: none;color: white;">
                  <h4 class="card-title text-decoration-none"><b>{{$fin->nombre}}</b></h4>
                  <p class="card-text text-decoration-none">{{$fin->ubicacion}}</p>                  
                </a>
              </div>              
            </div>         
        </div>      
      @php $cont++; @endphp
    @endforeach
  </div>
</div>
<!--/CARRUCEL CARDS 5-->

@endsection

@extends('layouts.app_home')


@section('content')

<!--CARRUCEL DE IMAGENES-->


@php //echo "<pre>"; print_r($aux_listado); echo "</pre>"; 
@endphp
<div class="container-xl mx-auto">
  <br>
  <div class="card mb-3 mx-auto" >
    <div class="row no-gutters">
      <div class="col-md-4">
        <br>
        <img src="{{ url('/') }}/{{$detalle['imagen']}}" class="card-img ml-4 mb-4" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><b>{{ strtoupper($detalle['titulo'])}}</b></h5>
          <p class="card-text">
              @php print($detalle['texto']); @endphp
          </p>          
        </div>
      </div>
    </div>
  </div>
</div> 

<div class="container-xl mx-auto">
  
  <div class="row">
    @if(count($aux_listado)>0) 
      <div class="col-md-5 col-10 m-4 ">
        <div class="list-group">
          <div class="list-group-item list-group-item-action active">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{strtoupper($titulo1)}}</h5>            
            </div>         
          </div>
          @foreach($aux_listado as $a_l)
            <a href="{{ url('/') }}/pagina_detalle/{{$a_l['id']}}/{{$a_l['tipo']}}" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$a_l['nombre']}}</h5>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    @endif
    @if(count($aux_listado2)>0) 
      <div class="col-md-5 col-10 m-4 ">
        <div class="list-group">
          <div class="list-group-item list-group-item-action active">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{strtoupper($titulo2)}}</h5>            
            </div>         
          </div>
          @foreach($aux_listado2 as $a_l)
            <a href="{{ url('/') }}/pagina_detalle/{{$a_l['id']}}/{{$a_l['tipo']}}" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$a_l['nombre']}}</h5>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
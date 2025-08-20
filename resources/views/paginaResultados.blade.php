
@extends('layouts.app_home')


@section('content')
 @php
    //print_r($chek_filtros);
 @endphp
<div class="row">
    <div class="col-3">
        <div class="wrapper" style="height: 100% !important">

            <!--Sidebar-->

            <nav id="sidebar" style="z-index: 10;">
                <div class="sidebar-header">
                    <h3>Filtros</h3>
                </div>
                <form method="POST" action="{{ route('pagina_resultados') }}">
                    @csrf
                    <input type="hidden" name="texto_busqueda" value="{{$texto_busqueda}}">
                    <ul class="list-unstyled components ml-4">         
                        <li>           
                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" value="filt_agricultor" id="filt_agricultor" name="chk_filtro[]"
                                @if(isset($chek_filtros) && in_array("filt_agricultor", $chek_filtros)) 
                                    {{"checked"}}
                                @endif
                                >
                                <label class="form-check-label" for="filt_agricultor">
                                Agricultores
                                </label>
                            </div>                      
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"  value="filt_animal" id="filt_animal" name="chk_filtro[]"
                                @if(isset($chek_filtros) && in_array("filt_animal", $chek_filtros)) 
                                     {{"checked"}}
                                @endif>
                                <label class="form-check-label" for="filt_animal">
                                Animales
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"  value="filt_finca" id="filt_finca" name="chk_filtro[]"
                                @if(isset($chek_filtros) && in_array("filt_finca", $chek_filtros)) 
                                    {{"checked"}}
                                @endif>
                                <label class="form-check-label" for="filt_finca">
                                Fincas
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"  value="filt_preparado" id="filt_preparado" name="chk_filtro[]"
                                
                                @if(isset($chek_filtros) && in_array("filt_preparado", $chek_filtros)) 
                                    {{"checked"}}
                                @endif>
                                <label class="form-check-label" for="filt_preparado" >
                       
                                Preparados
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"  value="filt_vegetal" id="filt_vegetal" name="chk_filtro[]" 
                                @if(isset($chek_filtros) && in_array("filt_vegetal", $chek_filtros)) 
                                    {{"checked"}}
                                @endif>
                                <label class="form-check-label" for="filt_vegetal">
                                Vegetales
                                </label>
                            </div>
                        </li>
                        <li>
                            <input type="submit" class="btn btn-success" value="Filtrar">
                        </li>
                    </ul>
                </form>
            </nav>

            <!--/Sidebar-->
             
            <!--botton collapse filtros-->
             
            <div id="content">
                <nav class="navbar navbar-expand-lg navbar-light" style="z-index: 10">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-success" style="    padding-right: 0px !important;
                        padding-left: 0px !important;                        
                        margin-left: -1em !important;"> 
                            <span class="carousel-control-next-icon" style="height: 25px; width: 25px;" aria-hidden="true"></span>
                            
                        </button>

                    </div>
                </nav>
            </div>

            <!--/botton collapse filtros-->

        </div>
    </div>

    <!---cards row-->
    <div class="col-1">
    </div>
    <div class="col-7 col-md-8 cont_results">
        
        @if(count($resultados)>0)
            @foreach($resultados as $res)
                <div class="form-group row">
                    <div class="card mb-3 col-md-8" > 
                        <div class="row">                                
                            <div class="col-md-4">
                                <a href="{{ url('/') }}/pagina_detalle/{{$res['id']}}/{{$res['tipo']}}">
                                    <img src="{{ url('/') }}/img/{{$res['imagen']}}" style="ax-width: 150px; max-height: 100px;" class=" mt-4 mb-4 img_result" alt="...">
                                </a>
                            </div>
                            <div class="col-md-8 pt-4">                                
                                
                                <div class="card-body">                            
                                    <a href="{{ url('/') }}/pagina_detalle/{{$res['id']}}/{{$res['tipo']}}"><b>{{strtoupper($res['titulo'])}}</b>
                                    </a>    
                                    <br>
                                    
                                    <p>{{$res['tipo_muestra']}}</p>    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="form-group row">
                <div class="col-12">No se encontraron resultados que coinsidan con el criterio de busqueda</div>
            </div>
        @endif
    </div>
    <!---/cards row-->
</div>
@endsection
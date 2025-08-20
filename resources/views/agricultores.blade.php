
@extends('layouts.app')


@section('content')

<link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Gestión Agricultores</div>

                <div class="card-body">
                    <input type="button" class="btn btn-success mb-2 float-right" data-toggle="modal" data-target="#registro" value="Nuevo"
                    onclick="
                        document.getElementById('nombres').value='';
                        document.getElementById('apellidos').value='';
                        document.getElementById('telefono').value='';
                        document.getElementById('documento').value='';
                        document.getElementById('id_edita').value='">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th><th>Imagen</th><th>Nombre</th><th>Apellido</th><th>Telefono</th><th>Documento</th>
                                <th>Datos Trabajo</th>
                                <th></th>

                            </tr>
                        <thead>
                        <tbody>
                        @php $cont = 0; @endphp
                        @foreach($registros as $agricultores)
                            @php $cont++; @endphp
                            <tr>
                                <td>{{$cont}}</td>                            
                                <td><img style="max-width: 2em;" src="img/agricultores/{{$agricultores->imagen}}"></td>
                                <td>{{$agricultores->nombres}}</td>
                                <td>{{$agricultores->apellidos}}</td>
                                <td>{{$agricultores->telefono}}</td>
                                <td>{{$agricultores->documento}}</td>
                                <td>
                                    <input type="button" class="btn btn-primary" value="Datos Trabajo" data-toggle="modal" data-target="#datos" onclick="cargar_fincas('{{$agricultores->id}}')">
                                </td>
                                <td >

                                    <input type="button" class="btn btn-success float-right mr-2" data-toggle="modal" data-target="#registro" value="Editar" onclick="
                                        document.getElementById('nombres').value='{{$agricultores->nombres}}';
                                        document.getElementById('apellidos').value='{{$agricultores->apellidos}}';
                                        document.getElementById('telefono').value='{{$agricultores->telefono}}';
                                        document.getElementById('documento').value='{{$agricultores->documento}}';
                                        document.getElementById('id_edita').value='{{$agricultores->id}}';
                                        ">

                                <form method="POST" action="{{ route('agricultores_eliminar') }}" onsubmit="if(!confirm('esta seguro de eliminar este registro')){ return false;}">
                                        @csrf
                                        <input type="hidden" name="id_elimina" value="{{ $agricultores->id}}">
                                        <input type="submit" class="btn btn-danger float-right mr-2" value="Eliminar">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Datos Agricultores</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('agricultores_guardar') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_edita" id="id_edita">
                <div class="modal-body">
                
                    <div class="form-group row">
                      <label for="nombres" class="col-sm-2 col-form-label">Nombres*</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="nombres" name="nombres" value="" required>
                      </div>
                    
                      <label for="apellidos" class="col-sm-2 col-form-label">Apellidos*</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="telefono" class="col-sm-2 col-form-label">Teléfono*</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="telefono" name="telefono" value="" required>
                        </div>
                    
                        <label for="documento" class="col-sm-2 col-form-label" >Documento*</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="documento" name="documento" value="" required>
                        </div>
                    </div>
                            
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="imagen">Imagen*</label>                    
                        <div class="col-sm-10">    
                            <input type="file" style="padding-bottom: 2.5em !important" class="form-control mt-2 mb-2" id="imagen" name="imagen">
                        </div>
                    </div>
                     

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="datos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Datos Trabajo Agricultor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('agricultores_guardar') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_agricultor_datos" id="id_agricultor_datos">
                <input type="hidden" name="token_id" id="token_id" value="{{ csrf_token() }}">
                
                <div class="modal-body"> 
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="imagen">Agregar Fincas</label>                    
                        <div class="col-sm-7">    
                            <select class="col-10 js-example-basic-multiple" id="fincas_agregar" name="fincas_agregar[]"  multiple="multiple">    
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success" onClick="fincas_agricultor_guardar()">
                                Agregar 
                            </button>
                        </div>
                    </div>
                    <div class="form-group row mr-1 ml-1">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th><th>Finca</th><th>Lugar</th>
                                    <th></th>    
                                </tr>
                            <thead>                                
                            <tbody id="listado_fincas">   
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="animales_agregar">Agregar Animales</label>                    
                        <div class="col-sm-7">    
                            <select class="col-10 js-example-basic-multiple" id="animales_agregar" name="animales_agregar[]"  multiple="multiple">    
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success" onClick="animales_agricultor_guardar()">
                                Agregar 
                            </button>
                        </div>
                    </div>
                    <div class="form-group row mr-1 ml-1">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th><th>Raza</th><th>Especie</th>
                                    <th></th>    
                                </tr>
                            <thead>                                
                            <tbody id="listado_animales">   
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="vegetales_agregar">Agregar Vegetales</label>                    
                        <div class="col-sm-7">    
                            <select class="col-10 js-example-basic-multiple" id="vegetales_agregar" name="vegetales_agregar[]"  multiple="multiple">    
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success" onClick="vegetales_agricultor_guardar()">
                                Agregar 
                            </button>
                        </div>
                    </div>
                    <div class="form-group row mr-1 ml-1">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th><th>Especie</th><th>Observacion</th>
                                    <th></th>    
                                </tr>
                            <thead>                                
                            <tbody id="listado_vegetales">   
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="preparados_agregar">Agregar Preparados</label>                    
                        <div class="col-sm-7">    
                            <select class="col-10 js-example-basic-multiple" id="preparados_agregar" name="preparados_agregar[]"  multiple="multiple">    
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success" onClick="preparados_agricultor_guardar()">
                                Agregar 
                            </button>
                        </div>
                    </div>
                    <div class="form-group row mr-1 ml-1">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th><th>Preparado</th><th>Observacion</th>
                                    <th></th>    
                                </tr>
                            <thead>                                
                            <tbody id="listado_preparados">   
                            </tbody>
                        </table>
                    </div>                   
                </div>
                
            </form>
          </div>
        </div>
    </div>
</div>


@endsection


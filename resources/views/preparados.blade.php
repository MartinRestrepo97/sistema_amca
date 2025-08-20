
@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Gestión Preparados</div>

                <div class="card-body">
                    <input type="button" class="btn btn-success mb-2 float-right" data-toggle="modal" data-target="#registro" value="Nuevo"
                    onclick="
                        document.getElementById('nombre').value='';
                        document.getElementById('preparacion').value='';                     
                        document.getElementById('observaciones').value='';
                        document.getElementById('id_edita').value='">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th><th>Nombre</th><th>Imagen</th><th>Preparación</th><th></th>
                            </tr>
                        <thead>
                        <tbody>
                        @php $cont = 0; @endphp
                        @foreach($registros as $preparado)
                            @php $cont++; @endphp
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$preparado->nombre}}</td>
                                <td><img style="max-width: 2em;" src="img/preparados/{{$preparado->imagen}}"></td>
                                <td>{{$preparado->preparacion}}</td>
                                <td >

                                    <input type="button" class="btn btn-success float-right mr-2" data-toggle="modal" data-target="#registro" value="Editar" onclick="
                                        document.getElementById('nombre').value='{{$preparado->nombre}}';
                                        document.getElementById('preparacion').value='{{$preparado->preparacion}}';
                                        document.getElementById('observaciones').value='{{$preparado->observaciones}}';
                                        document.getElementById('id_edita').value='{{$preparado->id}}';">

                                <form method="POST" action="{{ route('preparados_eliminar') }}" onsubmit="if(!confirm('esta seguro de eliminar este registro')){ return false;}">
                                        @csrf
                                        <input type="hidden" name="id_elimina" value="{{ $preparado->id}}">
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
              <h5 class="modal-title" id="exampleModalLabel">Datos Preparado</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('preparados_guardar') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_edita" id="id_edita">
                <div class="modal-body">
                
                    <div class="form-group row">
                      <label for="nombre" class="col-sm-2 col-form-label">Nombre*</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="" required>
                      </div>                      
                    </div>
                    <div class="form-group row">
                        <label for="preparacion" class="col-sm-2 col-form-label" required>Preparacion*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="preparacion" name="preparacion" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="observaciones" class="col-sm-2 col-form-label" required>Observación*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="2"></textarea>
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
</div>
@endsection


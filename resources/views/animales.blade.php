
@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Gestión Animales</div>

                <div class="card-body">
                    <input type="button" class="btn btn-success mb-2 float-right" data-toggle="modal" data-target="#registro" value="Nuevo"
                    onclick="
                        document.getElementById('especie').value='';
                        document.getElementById('raza').value='';
                        document.getElementById('alimentacion').value='';
                        document.getElementById('reproduccion').value='';
                        document.getElementById('cuidados').value='';
                        document.getElementById('observacion').value='';
                        document.getElementById('id_edita').value='">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th><th>Especie</th><th>Imagen</th><th>Raza</th><th></th>
                            </tr>
                        <thead>
                        <tbody>
                        @php $cont = 0; @endphp
                        @foreach($registros as $animal)
                            @php $cont++; @endphp
                            <tr>
                                <td>{{$cont}}</td>                            
                                <td>{{$animal->especie}}</td>
                                <td><img style="max-width: 2em;" src="img/animales/{{$animal->imagen}}"></td>
                                <td>{{$animal->raza}}</td>
                                <td >

                                    <input type="button" class="btn btn-success float-right mr-2" data-toggle="modal" data-target="#registro" value="Editar" 
                                    
                                    onclick="
                                        document.getElementById('especie').value='{{$animal->especie}}';
                                        document.getElementById('raza').value='{{$animal->raza}}';
                                        document.getElementById('alimentacion').value='{{$animal->alimentacion}}';
                                        document.getElementById('reproduccion').value='{{$animal->reproduccion}}';
                                        document.getElementById('cuidados').value='{{$animal->cuidados}}';
                                        document.getElementById('observacion').value='{{$animal->observaciones}}';
                                        document.getElementById('id_edita').value='{{$animal->id}}';
                                        ">

                                <form method="POST" action="{{ route('animal_eliminar') }}" onsubmit="if(!confirm('esta seguro de eliminar este registro')){ return false;}">
                                        @csrf
                                        <input type="hidden" name="id_elimina" value="{{ $animal->id}}">
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
              <h5 class="modal-title" id="exampleModalLabel">Datos Animal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('guardar_animal') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_edita" id="id_edita">
                <div class="modal-body">
                
                    <div class="form-group row">
                      <label for="especie" class="col-sm-2 col-form-label">Especie*</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="especie" name="especie" value="" required>
                      </div>
                    
                      <label for="raza" class="col-sm-2 col-form-label">Raza*</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="raza" name="raza" required>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="alimentacion" class="col-sm-2 col-form-label">Alimentación*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="alimentacion" name="alimentacion" rows="2" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reproduccion" class="col-sm-2 col-form-label" >Reproducción*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="reproduccion" name="reproduccion" rows="2" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cuidados" class="col-sm-2 col-form-label" >Cuidados*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="cuidados" name="cuidados" required rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="observacion" class="col-sm-2 col-form-label" >Observación*</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="observacion" name="observacion" required rows="2"></textarea>
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


<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Agricultor;
use App\Animal;
use App\Finca;
use App\Preparado;
use App\Vegetal;
use App\AgricultorFinca;
use App\AgricultorAnimal;
use App\AgricultorVegetal; 
use App\AgricultorPreparado;
use Illuminate\Support\Facades\DB;

class PaginaController extends Controller

{
    use AuthorizesRequests, ValidatesRequests;
    
    public function index()
    {
        
        $agrigultores = Agricultor::orderBy('id','desc')->limit(4)->get();
        $animales = Animal::orderBy('id','desc')->limit(4)->get();
        $vegetales = Vegetal::orderBy('id','desc')->limit(4)->get();
        $preparados = Preparado::orderBy('id','desc')->limit(4)->get();
        $agricultores = Agricultor::orderBy('id','desc')->limit(4)->get();
        $fincas = Finca::orderBy('id','desc')->limit(4)->get();
        
        return view('paginaHome', ['agricultores' => $agricultores ,'animales' => $animales ,'vegetales' => $vegetales ,'preparados' => $preparados ,'fincas' => $fincas] );

        
    }
   
    
    public function resultados(Request $request)
    {
        //echo "llega"; exit; die;
        //echo $request['texto_busqueda']; exit; die;
        /*
        $registros = Agricultor::select('id',DB::raw("CONCAT('nombres',' ','apellidos') as titulo"),'imagen')->where('nombres','like',$request['texto_busqueda'].'%')->orWhere('apellidos','like',$request['texto_busqueda'].'%')->orderBy("nombres")->orderBy("apellidos");*/
        $filtros = array();
        $resultados = array();
        if(isset($request['chk_filtro'])) { $filtros = $request['chk_filtro'];} 
        //BUSCANDO AGRICULTORES
        if(
            (isset($request['chk_filtro']) && count($request['chk_filtro'])>0 && in_array("filt_agricultor", $request['chk_filtro']))
            ||
            (!isset($request['chk_filtro'])||count($request['chk_filtro'])==0)
        ) {            
            $registros = Agricultor::select('id',DB::raw("CONCAT(nombres,' ',apellidos) as titulo"),'imagen')
                                    ->where('nombres','like',$request['texto_busqueda'].'%')
                                    ->orWhere('apellidos','like',$request['texto_busqueda'].'%')
                                    ->orderBy('nombres')
                                    ->orderBy('apellidos')
                                    ->get();
            
            foreach($registros as $reg) {
                $resultados[] = array("id"=>$reg->id, "titulo"=>$reg->titulo, "imagen"=>"agricultores/".$reg->imagen,"tipo"=>"agricultor","tipo_muestra"=>"Agricultor");
            }
        }
        //BUSCANDO FINCAS
        if(
            (isset($request['chk_filtro']) && count($request['chk_filtro'])>0 && in_array("filt_finca", $request['chk_filtro']))
            ||
            (!isset($request['chk_filtro'])||count($request['chk_filtro'])==0)
        ) {
            $registros = Finca::select('id', DB::raw("CONCAT(nombre,' (',ubicacion ,')') as titulo"), 'imagen')
                               ->where('nombre', 'like', $request['texto_busqueda'].'%')
                               ->orderBy('nombre')
                               ->get();

            foreach ($registros as $reg) {
                $resultados[] = array("id"=>$reg->id, "titulo"=>$reg->titulo, "imagen"=>"finca/".$reg->imagen,"tipo"=>"finca","tipo_muestra"=>"Finca");
            }
        }
        

        //BUSCANDO ANIMALES
        if(
            (isset($request['chk_filtro']) && count($request['chk_filtro'])>0 && in_array("filt_animal", $request['chk_filtro']))
            ||
            (!isset($request['chk_filtro'])||count($request['chk_filtro'])==0)
        ) {
            $registros = Animal::select('id', DB::raw("CONCAT(especie,' - ',raza ) as titulo"), 'imagen')
                               ->where('especie', 'like', $request['texto_busqueda'].'%')
                               ->orderBy('especie')
                               ->get();

            foreach ($registros as $reg) {
                $resultados[] = array("id"=>$reg->id, "titulo"=>$reg->titulo, "imagen"=>"animales/".$reg->imagen,"tipo"=>"animal","tipo_muestra"=>"Animal");
            }
        }

        //BUSCANDO PREPARADOS
        if(
            (isset($request['chk_filtro']) && count($request['chk_filtro'])>0 && in_array("filt_preparado", $request['chk_filtro']))
            ||
            (!isset($request['chk_filtro'])||count($request['chk_filtro'])==0)
        ) {
            $registros = Preparado::select('id', 'nombre as titulo', 'imagen')
                               ->where('nombre', 'like', $request['texto_busqueda'].'%')
                               ->orderBy('nombre')
                               ->get();

            foreach ($registros as $reg) {
                $resultados[] = array("id"=>$reg->id, "titulo"=>$reg->titulo, "imagen"=>"preparados/".$reg->imagen,"tipo"=>"preparado","tipo_muestra"=>"Preparado");
            }
        }

        //BUSCANDO VEGETALES
        if(
            (isset($request['chk_filtro']) && count($request['chk_filtro'])>0 && in_array("filt_vegetal", $request['chk_filtro']))
            ||
            (!isset($request['chk_filtro'])||count($request['chk_filtro'])==0)
        ) {
            $registros = Vegetal::select('id', DB::raw("CONCAT(especie,' - ',cultivo ) as titulo"), 'imagen')
                               ->where('especie', 'like', $request['texto_busqueda'].'%')
                               ->orderBy('especie')
                               ->get();

            foreach ($registros as $reg) {
                $resultados[] = array("id"=>$reg->id, "titulo"=>$reg->titulo, "imagen"=>"vegetales/".$reg->imagen,"tipo"=>"vegetal","tipo_muestra"=>"Vegetal");
            }
        }


        return view('paginaResultados', ['resultados' => $resultados,"texto_busqueda"=>$request['texto_busqueda'],"chek_filtros" => $filtros ] );
        
    }

    public function detalles(Request $request)
    {
        
        //$registros = Agricultor::all();
        $detalle = array(); 
        $aux_listado = array();
        $aux_for = array();
        $aux_listado2 = array();
        $titulo1 = "";
        $titulo2 = "";
        if($request['tipo'] == 'vegetal') {

            $aux_det = Vegetal::find($request['id']);
            $titulo1 = "Agricultores que cultivan este vegetal";
            $titulo2 = "Fincas donde se cultivan este vegetal";
            $detalle['imagen'] = "img/vegetales/".$aux_det->imagen;
            $detalle['titulo'] = $aux_det->especie;
            $detalle['texto'] = "<b>Cultivo</b><br>".$aux_det->cultivo;          
            $detalle['texto'].= "<br><br><b>Observaciones</b><br>".$aux_det->observaciones;

            //Cargando listado de agricultores que cultivan este vegetal
            $aux_listado_pre = AgricultorVegetal::select('id_agricultor','nombres','apellidos')
                                            ->join('agricultores', 'agricultores_vegetales.id_agricultor', '=', 'agricultores.id')
                                            ->where('id_vegetal',$request['id'])        
                                            ->orderBy('nombres')
                                            ->orderBy('apellidos')
                                            ->get();
            
            if(count($aux_listado_pre)>0) {
                foreach($aux_listado_pre as $a_l) {
                    
                   

                    $aux_for[] = $a_l->id_agricultor;
                    $aux_listado[] = array("id"=>$a_l->id_agricultor,"nombre" =>  strtoupper($a_l->nombres)." ". strtoupper($a_l->apellidos),"tipo" => "agricultor");
                }
                
                
                if(count($aux_for)>0) {
                    $aux_listado2_pre = AgricultorFinca::select('id_finca','nombre','ubicacion')
                                    ->join('finca','agricultores_fincas.id_finca','finca.id')                                    
                                    ->whereIn('id_agricultor',$aux_for)
                                    ->groupBy('id_finca')
                                    ->groupBy('nombre')
                                    ->groupBy('ubicacion')
                                    ->orderBy('nombre')
                                    ->get();
    
                    if (count($aux_listado2_pre)>0) {
                        foreach ($aux_listado2_pre as $a_l) {
                            $aux_listado2[] = array("id"=>$a_l->id_finca,"nombre" => strtoupper($a_l->nombre)." ".$a_l->ubicacion,"tipo" => "finca");
                        }
                        //echo "<pre>"; print_r($aux_listado); echo "</pre>"; exit; die;
                    }

                }
            }

        }
        if($request['tipo'] == 'animal') {

            $aux_det = Animal::find($request['id']);
            $titulo1 = "Agricultores que crian este animal";
            $titulo2 = "Fincas donde se crian este animal";
            $detalle['imagen'] = "img/animales/".$aux_det->imagen;
            $detalle['titulo'] = $aux_det->especie;
            $detalle['texto'] = "<b>Raza</b><br>".$aux_det->raza;          
            $detalle['texto'].= "<br><br><b>Observaciones</b><br>".$aux_det->observaciones;

            //Cargando listado de agricultores que crian este animal
            $aux_listado_pre = AgricultorAnimal::select('id_agricultor','nombres','apellidos')
                                            ->join('agricultores', 'agricultores_animales.id_agricultor', '=', 'agricultores.id')
                                            ->where('id_animal',$request['id'])        
                                            ->orderBy('nombres')
                                            ->orderBy('apellidos')
                                            ->get();
            
            if(count($aux_listado_pre)>0) {
                foreach($aux_listado_pre as $a_l) {
                    
                   

                    $aux_for[] = $a_l->id_agricultor;
                    $aux_listado[] = array("id"=>$a_l->id_agricultor,"nombre" =>  strtoupper($a_l->nombres)." ". strtoupper($a_l->apellidos),"tipo" => "agricultor");
                }
                
                
                if(count($aux_for)>0) {
                    $aux_listado2_pre = AgricultorFinca::select('id_finca','nombre','ubicacion')
                                    ->join('finca','agricultores_fincas.id_finca','finca.id')                                    
                                    ->whereIn('id_agricultor',$aux_for)
                                    ->groupBy('id_finca')
                                    ->groupBy('nombre')
                                    ->groupBy('ubicacion')
                                    ->orderBy('nombre')
                                    ->get();
    
                    if (count($aux_listado2_pre)>0) {
                        foreach ($aux_listado2_pre as $a_l) {
                            $aux_listado2[] = array("id"=>$a_l->id_finca,"nombre" => strtoupper($a_l->nombre)." ".$a_l->ubicacion,"tipo" => "finca");
                        }
                        //echo "<pre>"; print_r($aux_listado); echo "</pre>"; exit; die;
                    }

                }
            }
        }
        if($request['tipo'] == 'preparado') {

            $aux_det = Preparado::find($request['id']);
            $titulo1 = "Agricultores quienes crean este preparado";
            $titulo2 = "Fincas donde proviene este preparado";
            $detalle['imagen'] = "img/preparados/".$aux_det->imagen;
            $detalle['titulo'] = $aux_det->nombre;
            $detalle['texto'] = "<b>Preparacion</b><br>".$aux_det->preparacion;          
            $detalle['texto'].= "<br><br><b>Observaciones</b><br>".$aux_det->observaciones;

            //Cargando listado de agricultores que cultivan este preparado
            $aux_listado_pre = AgricultorPreparado::select('id_agricultor','nombres','apellidos')
                                            ->join('agricultores', 'agricultores_preparados.id_agricultor', '=', 'agricultores.id')
                                            ->where('id_preparado',$request['id'])        
                                            ->orderBy('nombres')
                                            ->orderBy('apellidos')
                                            ->get();
            
            if(count($aux_listado_pre)>0) {
                foreach($aux_listado_pre as $a_l) {
                    
                   

                    $aux_for[] = $a_l->id_agricultor;
                    $aux_listado[] = array("id"=>$a_l->id_agricultor,"nombre" =>  strtoupper($a_l->nombres)." ". strtoupper($a_l->apellidos),"tipo" => "agricultor");
                }
                
                
                if(count($aux_for)>0) {
                    $aux_listado2_pre = AgricultorFinca::select('id_finca','nombre','ubicacion')
                                    ->join('finca','agricultores_fincas.id_finca','finca.id')                                    
                                    ->whereIn('id_agricultor',$aux_for)
                                    ->groupBy('id_finca')
                                    ->groupBy('nombre')
                                    ->groupBy('ubicacion')
                                    ->orderBy('nombre')
                                    ->get();
    
                    if (count($aux_listado2_pre)>0) {
                        foreach ($aux_listado2_pre as $a_l) {
                            $aux_listado2[] = array("id"=>$a_l->id_finca,"nombre" => strtoupper($a_l->nombre)." ".$a_l->ubicacion,"tipo" => "finca");
                        }
                        //echo "<pre>"; print_r($aux_listado); echo "</pre>"; exit; die;
                    }

                }
            }

        }
        if($request['tipo'] == 'finca') {

            $aux_det = Finca::find($request['id']);
            $titulo1 = "Agricultores";
            $titulo2 = "Fincas";
            $detalle['imagen'] = "img/finca/".$aux_det->imagen;
            $detalle['titulo'] = $aux_det->nombre;
            $detalle['texto'] = "<b>Ubicacion</b><br>".$aux_det->ubicacion;          
            $detalle['texto'].= "<br><br><b>Observaciones</b><br>".$aux_det->observaciones;

            //Cargando listado de agricultores que trabajan en  este finca
            $aux_listado_pre = AgricultorFinca::select('id_agricultor','nombres','apellidos')
                                            ->join('agricultores', 'agricultores_fincas.id_agricultor', '=', 'agricultores.id')
                                            ->where('id_finca',$request['id'])        
                                            ->orderBy('nombres')
                                            ->orderBy('apellidos')
                                            ->get();
            
            if(count($aux_listado_pre)>0) {
                foreach($aux_listado_pre as $a_l) {
                    
                   

                    $aux_for[] = $a_l->id_agricultor;
                    $aux_listado[] = array("id"=>$a_l->id_agricultor,"nombre" =>  strtoupper($a_l->nombres)." ". strtoupper($a_l->apellidos),"tipo" => "agricultor");
                }
                
                
               
            }

        }
        if($request['tipo'] == 'agricultor') {

            $aux_det = Agricultor::find($request['id']);
            $titulo1 = "Agricultores";
            $titulo2 = "Fincas";
            $detalle['imagen'] = "img/agricultores/".$aux_det->imagen;
            $detalle['titulo'] = $aux_det->nombres;
            $detalle['texto'] = "<b>Telefono</b><br>".$aux_det->telefono;          
            $detalle['texto'].= "<br><br><b>Documento</b><br>".$aux_det->documento;

            $aux_listado_pre = AgricultorFinca::select('id_agricultor','nombre','ubicacion','id_finca')
            ->join('finca', 'agricultores_fincas.id_finca', '=', 'finca.id')
            ->where('id_agricultor',$request['id'])        
            ->orderBy('nombre')            
            ->get();
            
            if(isset($aux_listado_pre[0])) {
                $aux_alp = $aux_listado_pre[0];                
                $detalle['texto'].= "<br><br><b>Finca</b><br><a href='".url('/')."/pagina_detalle/".$aux_alp['id_finca']."/finca'>".strtoupper($aux_alp['nombre'])." - ".strtoupper($aux_alp['ubicacion']."</a>");
            }
        }
        
        //return view('agricultores', ['registros' => $registros ] );
        return view('paginaDetalles', [ 'detalle' => $detalle ,'aux_listado' => $aux_listado ,'aux_listado2' => $aux_listado2 , 'titulo1' => $titulo1 , 'titulo2' => $titulo2]);
    }

    public function guardar(Request $request ) 
    {   

        
        if (isset($request['id_edita']) && $request['id_edita']!='') {
            $registro = Agricultor::find($request['id_edita']);            
        } else {
            $registro = new Agricultor();
            $registro->imagen = ''; 
        }
        
        $registro->nombres = $request['nombres'];
        $registro->apellidos = $request['apellidos'];
        $registro->telefono = $request['telefono'];
        $registro->documento = $request['documento'];    
        $registro->save();

        if (isset($_FILES["imagen"]["tmp_name"]) && $_FILES["imagen"]["tmp_name"] !='') {
            $tmp_name = $_FILES["imagen"]["tmp_name"];
            $name = $_FILES["imagen"]["name"];
            
            move_uploaded_file($tmp_name, "img/agricultores/".$registro->id."_$name");

            $registro->imagen = $registro->id."_$name";
            $registro->save();
        }
        

        

        return redirect()->route('agricultores');
    }

    public function eliminar(Request $request) {        
        Agricultor::destroy($request['id_elimina']);
        return redirect()->route('agricultores');
    }
//----------------------------------------------------------------------------
    public function get_agricultor_fincas(Request $request) {

        $agricultorfincas = AgricultorFinca::select("agricultores_fincas.id","agricultores_fincas.id_agricultor","agricultores_fincas.id_finca","finca.nombre", "finca.ubicacion")
        ->join('finca','agricultores_fincas.id_finca','finca.id')
        ->where('id_agricultor',$request['id_agricultor'])->get();

        $id_fincas = array();
        $fincas = array();
        if(count($agricultorfincas)>0) {
            foreach($agricultorfincas as $f) {
                $id_fincas[] = $f->id_finca;
            }

            
        }

        $fincas = Finca::whereNotIn('id',$id_fincas)->orderBy('nombre')->get();
        return ['agricultorfincas' => $agricultorfincas, 'fincas' => $fincas, 'id_fincas' => $id_fincas ];
    }

    public function fincas_agricultor_guardar(Request $request) {
        $fincas_agrega = $request['fincas_agrega'];
        
        foreach($fincas_agrega as $fa) {
            $f = new AgricultorFinca();
            $f->id_agricultor = $request['id_agricultor'];
            $f->id_finca = $fa;
            $f->save();
        }
        return $fincas_agrega;
    }

    public function fincas_agricultor_eliminar(Request $request) {
        $contenedor = AgricultorFinca::findOrFail($request['id_registro']);        
        $contenedor->delete();
    }
//-------------------------------------------------------------------------------------
    public function get_agricultor_animales(Request $request) {

        $agricultorAnimal = AgricultorAnimal::select("agricultores_animales.id","agricultores_animales.id_agricultor","agricultores_animales.id_animal","animales.especie", "animales.raza")
        ->join('animales','agricultores_animales.id_animal','animales.id')
        ->where('id_agricultor',$request['id_agricultor'])->get();

        $id_animales = array();
        $animales = array();
        if(count($agricultorAnimal)>0) {
            foreach($agricultorAnimal as $f) {
                $id_animales[] = $f->id_animal;
            }

            
        }

        $animales = Animal::whereNotIn('id',$id_animales)->orderBy('especie')->orderBy('raza')->get();
        return ['agricultoranimales' => $agricultorAnimal, 'animales' => $animales ];
    }

    public function animales_agricultor_guardar(Request $request) {
        $fincas_agrega = $request['fincas_agrega'];
        
        foreach($fincas_agrega as $fa) {
            $f = new AgricultorAnimal();
            $f->id_agricultor = $request['id_agricultor'];
            $f->id_finca = $fa;
            $f->save();
        }
        return $fincas_agrega;
    }

    public function animales_agricultor_eliminar(Request $request) {
        $contenedor = AgricultorFinca::findOrFail($request['id_registro']);        
        $contenedor->delete();
    }
//------------------------------------------------------------------------------------
    public function get_agricultor_vegetales(Request $request) {

        $agricultorVegetal = AgricultorVegetal::select("agricultores_vegetales.id","agricultores_vegetales.id_agricultor","agricultores_vegetales.id_vegetal","vegetales.especie", "vegetales.cultivo")
        ->join('vegetales','agricultores_vegetales.id_vegetal','vegetales.id')
        ->where('id_agricultor',$request['id_agricultor'])->get();

        $id_vegetales = array();
        $vegetales = array();
        if(count($agricultorVegetal)>0) {
            foreach($agricultorVegetal as $f) {
                $id_vegetales[] = $f->id_vegetal;
            }

            
        }

        $vegetales = Vegetal::whereNotIn('id',$id_vegetales)->orderBy('especie')->orderBy('cultivo')->get();
        return ['agricultorvegetales' => $agricultorVegetal, 'vegetales' => $vegetales ];
    }

    public function vegetales_agricultor_guardar(Request $request) {
        $fincas_agrega = $request['fincas_agrega'];
        
        foreach($fincas_agrega as $fa) {
            $f = new AgricultorVegetal();
            $f->id_agricultor = $request['id_agricultor'];
            $f->id_finca = $fa;
            $f->save();
        }
        return $fincas_agrega;
    }

    public function vegetales_agricultor_eliminar(Request $request) {
        $contenedor = AgricultorFinca::findOrFail($request['id_registro']);        
        $contenedor->delete();
    }
//------------------------------------------------------------------------------------
    public function get_agricultor_preparados(Request $request) {

        $$agricultorPreparados = AgricultorPreparado::select("agricultores_preparados.id","agricultores_preparados.id_agricultor","agricultores_preparados.id_preparado","preparados.nombre", "preparados.preparacion")
        ->join('preparados','agricultores_preparados.id_preparado','preparados.id')
        ->where('id_agricultor',$request['id_agricultor'])->get();

        $$id_preparados = array();
        $preparados = array();
        if(count($$agricultorPreparados)>0) {

            foreach($$agricultorPreparados as $f) {
                $$id_preparados[] = $f->id_preparado;
            }

            
        }

        $preparados = Vegetal::whereNotIn('id',$$id_preparados)->orderBy('nombre')->orderBy('preparacion')->get();
        return ['agricultorpreparados' => $$agricultorPreparados, 'preparados' => $preparados ];
    }

    public function preparados_agricultor_guardar(Request $request) {
        $fincas_agrega = $request['fincas_agrega'];
        
        foreach($fincas_agrega as $fa) {
            $f = new AgricultorPreparado();
            $f->id_agricultor = $request['id_agricultor'];
            $f->id_finca = $fa;
            $f->save();
        }
        return $fincas_agrega;
    }

    public function preparados_agricultor_eliminar(Request $request) {
        $contenedor = AgricultorFinca::findOrFail($request['id_registro']);        
        $contenedor->delete();
    }
    
}

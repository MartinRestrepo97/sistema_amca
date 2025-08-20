<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Agricultor;
use App\AgricultorFinca;
use App\AgricultorAnimal;
use App\AgricultorVegetal; 
use App\AgricultorPreparado;
use App\Finca;
use App\Animal;
use App\Preparado;
use App\Vegetal;

class AgricultoresController extends Controller

{
    public function index()
    {
        
        $registros = Agricultor::all();

        
        return view('agricultores', ['registros' => $registros ] );
    }

    public function guardar(Request $request) 
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
        $animales_agrega = $request['animales_agrega'];
        
        foreach($animales_agrega as $fa) {
            $f = new AgricultorAnimal();
            $f->id_agricultor = $request['id_agricultor'];
            $f->id_animal = $fa;
            $f->save();
        }
        return $animales_agrega;
    }

    public function animales_agricultor_eliminar(Request $request) {
        $contenedor = AgricultorAnimal::findOrFail($request['id_registro']);        
        $contenedor->delete();
    }
//------------------------------------------------------------------------------------
    public function get_agricultor_vegetales(Request $request) {

        $agricultorvegetales = AgricultorVegetal::select("agricultores_vegetales.id","agricultores_vegetales.id_agricultor","agricultores_vegetales.id_vegetal","vegetales.especie", "vegetales.observaciones")
        ->join('vegetales','agricultores_vegetales.id_vegetal','vegetales.id')
        ->where('id_agricultor',$request['id_agricultor'])->get();

        $id_vegetales = array();
        $vegetales = array();
        if(count($agricultorvegetales)>0) {
            foreach($agricultorvegetales as $f) {
                $id_vegetales[] = $f->id_vegetal;
            }

            
        }

        $vegetales = Vegetal::whereNotIn('id',$id_vegetales)->orderBy('especie')->get();
        return ['agricultorvegetales' => $agricultorvegetales, 'vegetales' => $vegetales, 'id_vegetales' => $id_vegetales ];
    }

    public function vegetales_agricultor_guardar(Request $request) {
        $vegetales_agrega = $request['vegetales_agrega'];
        
        foreach($vegetales_agrega as $fa) {
            $f = new AgricultorVegetal();
            $f->id_agricultor = $request['id_agricultor'];
            $f->id_vegetal = $fa;
            $f->save();
        }
        return $vegetales_agrega;
    }

    public function vegetales_agricultor_eliminar(Request $request) {
        $contenedor = AgricultorVegetal::findOrFail($request['id_registro']);        
        $contenedor->delete();
    }

//------------------------------------------------------------------------------------
    public function get_agricultor_preparados(Request $request) {

        $agricultorpreparados = AgricultorPreparado::select("agricultores_preparados.id","agricultores_preparados.id_agricultor","agricultores_preparados.id_preparado","preparados.nombre", "preparados.observaciones")
        ->join('preparados','agricultores_preparados.id_preparado','preparados.id')
        ->where('id_agricultor',$request['id_agricultor'])->get();

        $id_preparados = array();
        $preparados = array();
        if(count($agricultorpreparados)>0) {
            foreach($agricultorpreparados as $f) {
                $id_preparados[] = $f->id_preparado;
            }

            
        }

        $preparados = Preparado::whereNotIn('id',$id_preparados)->orderBy('nombre')->get();
        return ['agricultorpreparados' => $agricultorpreparados, 'preparados' => $preparados, 'id_preparados' => $id_preparados ];
    }

    public function preparados_agricultor_guardar(Request $request) {
        $preparados_agrega = $request['preparados_agrega'];
        
        foreach($preparados_agrega as $fa) {
            $f = new AgricultorPreparado();
            $f->id_agricultor = $request['id_agricultor'];
            $f->id_preparado = $fa;
            $f->save();
        }
        return $preparados_agrega;
    }

    public function preparados_agricultor_eliminar(Request $request) {
        $contenedor = AgricultorPreparado::findOrFail($request['id_registro']);        
        $contenedor->delete();
    }

}

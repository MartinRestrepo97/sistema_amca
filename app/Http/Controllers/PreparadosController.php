<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Preparado;

class PreparadosController extends Controller
{
    public function index()
    {
        
        $registros = Preparado::all();
        
        return view('preparados', ['registros' => $registros ] );
    }

    public function guardar(Request $request) 
    {   
        if (isset($request['id_edita']) && $request['id_edita']!='') {
            $registro = Preparado::find($request['id_edita']);            
        } else {
            $registro = new Preparado();
            $registro->imagen = '';
        }
            
        $registro->nombre = $request['nombre'];
        $registro->preparacion = $request['preparacion'];        
        $registro->observaciones = $request['observaciones'];
        $registro->save();

        if (isset($_FILES["imagen"]["tmp_name"]) && $_FILES["imagen"]["tmp_name"] !='') {
            $tmp_name = $_FILES["imagen"]["tmp_name"];
            $name = $_FILES["imagen"]["name"];
            
            move_uploaded_file($tmp_name, "img/preparados/".$registro->id."_$name");

            $registro->imagen = $registro->id."_$name";
            $registro->save();
        }
        return redirect()->route('preparados');
    }
    

    public function eliminar(Request $request) {        
        Preparado::destroy($request['id_elimina']);
        return redirect()->route('preparados');
    }
}

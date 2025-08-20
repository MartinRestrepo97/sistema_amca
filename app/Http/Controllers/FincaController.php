<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Finca;

class FincaController extends Controller
{
    public function index()
    {
        
        $registros = Finca::all();
        
        return view('finca', ['registros' => $registros ] );
    }

    public function guardar(Request $request) 
    {   

        
        if (isset($request['id_edita']) && $request['id_edita']!='') {
            $registro = Finca::find($request['id_edita']);            
        } else {
            $registro = new Finca();
            $registro->imagen = ''; 
        }
        
        $registro->nombre = $request['nombre'];
        $registro->ubicacion = $request['ubicacion'];
        $registro->propietario = $request['propietario'];
        $registro->save();

        if (isset($_FILES["imagen"]["tmp_name"]) && $_FILES["imagen"]["tmp_name"] !='') {
            $tmp_name = $_FILES["imagen"]["tmp_name"];
            $name = $_FILES["imagen"]["name"];
            
            move_uploaded_file($tmp_name, "img/finca/".$registro->id."_$name");

            $registro->imagen = $registro->id."_$name";
            $registro->save();
        }
        

        

        return redirect()->route('finca');
    }

    public function eliminar(Request $request) {        
        Finca::destroy($request['id_elimina']);
        return redirect()->route('finca');
    }
}

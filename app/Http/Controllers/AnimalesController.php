<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Animal;

class AnimalesController extends Controller
{
    public function index()
    {
        
        $registros = Animal::all();
        
        return view('animales', ['registros' => $registros ] );
    }

    public function guardar(Request $request) 
    {   

        
        if (isset($request['id_edita']) && $request['id_edita']!='') {
            $registro = Animal::find($request['id_edita']);            
        } else {
            $registro = new Animal();
            $registro->imagen = ''; 
        }
        
        $registro->especie = $request['especie'];
        $registro->raza = $request['raza'];
        $registro->alimentacion = $request['alimentacion'];
        $registro->cuidados = $request['cuidados'];
        $registro->reproduccion = $request['reproduccion'];
        $registro->observaciones = $request['observacion'];     
        $registro->save();

        if (isset($_FILES["imagen"]["tmp_name"]) && $_FILES["imagen"]["tmp_name"] != '') {
            $tmp_name = $_FILES["imagen"]["tmp_name"];
            $name = $_FILES["imagen"]["name"];
            $fileName = $registro->id . "_" . $name;

            $destDir = public_path('img/animales');
            if (!is_dir($destDir)) {
                @mkdir($destDir, 0755, true);
            }

            $destPath = $destDir . DIRECTORY_SEPARATOR . $fileName;
            if (@move_uploaded_file($tmp_name, $destPath)) {
                $registro->imagen = $fileName; // La vista debe usar "/img/animales/{$registro->imagen}"
                $registro->save();
            }
        }
        

        

        return redirect()->route('animales');
    }

    public function eliminar(Request $request) {        
        Animal::destroy($request['id_elimina']);
        return redirect()->route('animales');
    }
}

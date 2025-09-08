<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preparado;

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

        if (isset($_FILES["imagen"]["tmp_name"]) && $_FILES["imagen"]["tmp_name"] != '') {
            $tmp_name = $_FILES["imagen"]["tmp_name"];
            $name = $_FILES["imagen"]["name"];
            $fileName = $registro->id . "_" . $name;

            $destDir = public_path('img/preparados');
            if (!is_dir($destDir)) {
                @mkdir($destDir, 0755, true);
            }

            $destPath = $destDir . DIRECTORY_SEPARATOR . $fileName;
            if (@move_uploaded_file($tmp_name, $destPath)) {
                $registro->imagen = $fileName; // La vista debe usar "/img/preparados/{$registro->imagen}"
                $registro->save();
            }
        }
        return redirect()->route('preparados');
    }
    

    public function eliminar(Request $request) {        
        Preparado::destroy($request['id_elimina']);
        return redirect()->route('preparados');
    }
}

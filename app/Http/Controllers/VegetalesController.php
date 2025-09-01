<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vegetal;

class VegetalesController extends Controller
{
    public function index()
    {
        
        $registros = Vegetal::all();
        
        return view('vegetales', ['registros' => $registros ] );
    }

    public function guardar(Request $request) 
    {   
        if (isset($request['id_edita']) && $request['id_edita']!='') {
            $registro = Vegetal::find($request['id_edita']);            
        } else {
            $registro = new Vegetal();
            $registro->imagen = '';
        }
            
        $registro->especie = $request['especie'];
        $registro->cultivo = $request['cultivo'];        
        $registro->observaciones = $request['observaciones'];  
        $registro->save();

        if (isset($_FILES["imagen"]["tmp_name"]) && $_FILES["imagen"]["tmp_name"] != '') {
            $tmp_name = $_FILES["imagen"]["tmp_name"];
            $name = $_FILES["imagen"]["name"];
            $fileName = $registro->id . "_" . $name;

            $destDir = public_path('img/vegetales');
            if (!is_dir($destDir)) {
                @mkdir($destDir, 0755, true);
            }

            $destPath = $destDir . DIRECTORY_SEPARATOR . $fileName;
            if (@move_uploaded_file($tmp_name, $destPath)) {
                $registro->imagen = $fileName; // La vista debe usar "/img/vegetales/{$registro->imagen}"
                $registro->save();
            }
        }

        return redirect()->route('vegetales');
    }

    public function eliminar(Request $request) {        
        Vegetal::destroy($request['id_elimina']);
        return redirect()->route('vegetales');
    }
}

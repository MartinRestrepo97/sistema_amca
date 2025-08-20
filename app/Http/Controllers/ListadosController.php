<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Animal;
use App\Vegetal;

class ListadosController extends Controller
{
    public function index()
    {
        
        $animales = Animal::orderBy('id', 'desc')->take(10)->get();
        $vegetales = Vegetal::orderBy('id', 'desc')->take(10)->get();
        
        return view('listados', ['animales' => $animales , 'vegetales' => $vegetales ] );
    }

  
}

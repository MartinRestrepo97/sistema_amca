<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Animal;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    public function index()
    {
        return response()->json(Animal::orderBy('id', 'desc')->get());
    }

    public function show(int $id)
    {
        $animal = Animal::findOrFail($id);
        return response()->json($animal);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'alimentacion' => 'nullable|string',
            'cuidados' => 'nullable|string',
            'reproduccion' => 'nullable|string',
            'observacion' => 'nullable|string',
            'imagen' => 'nullable|file|image|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $animal = new Animal($request->only(['especie','raza','alimentacion','cuidados','reproduccion']));
        // el modelo existente usa 'observaciones' en DB, el controlador web usa 'observacion'
        if ($request->filled('observacion')) {
            $animal->observaciones = $request->input('observacion');
        }
        $animal->imagen = '';
        $animal->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = $animal->id . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/animales'), $name);
            $animal->imagen = $name;
            $animal->save();
        }

        return response()->json($animal, 201);
    }

    public function update(Request $request, int $id)
    {
        $animal = Animal::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'especie' => 'sometimes|required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'alimentacion' => 'nullable|string',
            'cuidados' => 'nullable|string',
            'reproduccion' => 'nullable|string',
            'observacion' => 'nullable|string',
            'imagen' => 'nullable|file|image|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $animal->fill($request->only(['especie','raza','alimentacion','cuidados','reproduccion']));
        if ($request->has('observacion')) {
            $animal->observaciones = $request->input('observacion');
        }
        $animal->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = $animal->id . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/animales'), $name);
            $animal->imagen = $name;
            $animal->save();
        }

        return response()->json($animal);
    }

    public function destroy(int $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();
        return response()->json(null, 204);
    }
}

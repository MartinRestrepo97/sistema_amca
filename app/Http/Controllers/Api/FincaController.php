<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Finca;
use Illuminate\Support\Facades\Validator;

class FincaController extends Controller
{
    public function index()
    {
        return response()->json(Finca::orderBy('id','desc')->get());
    }

    public function show(int $id)
    {
        $item = Finca::findOrFail($id);
        return response()->json($item);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'nullable|string',
            'propietario' => 'nullable|string',
            'imagen' => 'nullable|file|image|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $item = new Finca($request->only(['nombre','ubicacion','propietario']));
        $item->imagen = '';
        $item->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = $item->id . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/finca'), $name);
            $item->imagen = $name;
            $item->save();
        }
        return response()->json($item, 201);
    }

    public function update(Request $request, int $id)
    {
        $item = Finca::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'ubicacion' => 'nullable|string',
            'propietario' => 'nullable|string',
            'imagen' => 'nullable|file|image|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $item->fill($request->only(['nombre','ubicacion','propietario']));
        $item->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = $item->id . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/finca'), $name);
            $item->imagen = $name;
            $item->save();
        }
        return response()->json($item);
    }

    public function destroy(int $id)
    {
        $item = Finca::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}

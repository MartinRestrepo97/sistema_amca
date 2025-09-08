<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agricultor;
use Illuminate\Support\Facades\Validator;

class AgricultorController extends Controller
{
    public function index()
    {
        return response()->json(Agricultor::orderBy('id','desc')->get());
    }

    public function show(int $id)
    {
        $item = Agricultor::findOrFail($id);
        return response()->json($item);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'documento' => 'nullable|string|max:100',
            'imagen' => 'nullable|file|image|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $item = new Agricultor($request->only(['nombres','apellidos','telefono','documento']));
        $item->imagen = '';
        $item->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = $item->id . '_' . $file->getClientOriginalName();
            $destDir = public_path('img/agricultores');
            if (!is_dir($destDir)) { @mkdir($destDir, 0755, true); }
            $file->move($destDir, $name);
            $item->imagen = $name;
            $item->save();
        }
        return response()->json($item, 201);
    }

    public function update(Request $request, int $id)
    {
        $item = Agricultor::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nombres' => 'sometimes|required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'documento' => 'nullable|string|max:100',
            'imagen' => 'nullable|file|image|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $item->fill($request->only(['nombres','apellidos','telefono','documento']));
        $item->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = $item->id . '_' . $file->getClientOriginalName();
            $destDir = public_path('img/agricultores');
            if (!is_dir($destDir)) { @mkdir($destDir, 0755, true); }
            $file->move($destDir, $name);
            $item->imagen = $name;
            $item->save();
        }
        return response()->json($item);
    }

    public function destroy(int $id)
    {
        $item = Agricultor::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}

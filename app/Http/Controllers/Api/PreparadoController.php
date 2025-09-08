<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preparado;
use Illuminate\Support\Facades\Validator;

class PreparadoController extends Controller
{
    public function index()
    {
        return response()->json(Preparado::orderBy('id','desc')->get());
    }

    public function show(int $id)
    {
        $item = Preparado::findOrFail($id);
        return response()->json($item);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'preparacion' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'imagen' => 'nullable|file|image|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $item = new Preparado($request->only(['nombre','preparacion','observaciones']));
        $item->imagen = '';
        $item->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = $item->id . '_' . $file->getClientOriginalName();
            $destDir = public_path('img/preparados');
            if (!is_dir($destDir)) { @mkdir($destDir, 0755, true); }
            $file->move($destDir, $name);
            $item->imagen = $name;
            $item->save();
        }
        return response()->json($item, 201);
    }

    public function update(Request $request, int $id)
    {
        $item = Preparado::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'preparacion' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'imagen' => 'nullable|file|image|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $item->fill($request->only(['nombre','preparacion','observaciones']));
        $item->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = $item->id . '_' . $file->getClientOriginalName();
            $destDir = public_path('img/preparados');
            if (!is_dir($destDir)) { @mkdir($destDir, 0755, true); }
            $file->move($destDir, $name);
            $item->imagen = $name;
            $item->save();
        }
        return response()->json($item);
    }

    public function destroy(int $id)
    {
        $item = Preparado::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}

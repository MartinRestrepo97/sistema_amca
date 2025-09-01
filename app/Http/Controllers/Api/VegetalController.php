<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vegetal;
use Illuminate\Support\Facades\Validator;

class VegetalController extends Controller
{
    public function index()
    {
        return response()->json(Vegetal::orderBy('id','desc')->get());
    }

    public function show(int $id)
    {
        $vegetal = Vegetal::findOrFail($id);
        return response()->json($vegetal);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'especie' => 'required|string|max:255',
            'cultivo' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'imagen' => 'nullable|file|image|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $vegetal = new Vegetal($request->only(['especie','cultivo','observaciones']));
        $vegetal->imagen = '';
        $vegetal->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = $vegetal->id . '_' . $file->getClientOriginalName();
            $destDir = public_path('img/vegetales');
            if (!is_dir($destDir)) { @mkdir($destDir, 0755, true); }
            $file->move($destDir, $name);
            $vegetal->imagen = $name;
            $vegetal->save();
        }
        return response()->json($vegetal, 201);
    }

    public function update(Request $request, int $id)
    {
        $vegetal = Vegetal::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'especie' => 'sometimes|required|string|max:255',
            'cultivo' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'imagen' => 'nullable|file|image|max:4096',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $vegetal->fill($request->only(['especie','cultivo','observaciones']));
        $vegetal->save();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = $vegetal->id . '_' . $file->getClientOriginalName();
            $destDir = public_path('img/vegetales');
            if (!is_dir($destDir)) { @mkdir($destDir, 0755, true); }
            $file->move($destDir, $name);
            $vegetal->imagen = $name;
            $vegetal->save();
        }
        return response()->json($vegetal);
    }

    public function destroy(int $id)
    {
        $vegetal = Vegetal::findOrFail($id);
        $vegetal->delete();
        return response()->json(null, 204);
    }
}

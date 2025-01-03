<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class UbicacionController extends Controller
{
    public function index()
    {
        $ubicaciones = Ubicacion::orderBy('idubicacion', 'DESC')->paginate(3);
        return view('ubicacion.index', compact('ubicaciones'));
    }

    public function create()
    {
        return view('ubicacion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreUbicacion' => 'required|string|max:254',
            'descripcionUbicacion' => 'required|string|max:254',
        ]);

        Ubicacion::create($request->only(['nombreUbicacion', 'descripcionUbicacion']));

        return redirect()->route('ubicacion.index')->with('success', 'Ubicación creada exitosamente');
    }

    public function show(string $id)
    {
        $ubicacion = Ubicacion::findOrFail($id); // Usa `findOrFail` para manejar errores.
        return view('ubicacion.show', compact('ubicacion'));
    }

    public function edit(string $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        return view('ubicacion.edit', compact('ubicacion'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombreUbicacion' => 'required|string|max:254',
            'descripcionUbicacion' => 'required|string|max:254',
        ]);

        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->update($request->only(['nombreUbicacion', 'descripcionUbicacion']));

        return redirect()->route('ubicacion.index')->with('success', 'Ubicación actualizada exitosamente');
    }

    public function destroy(string $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->delete();

        return redirect()->route('ubicacion.index')->with('success', 'Ubicación eliminada exitosamente');
    }
}

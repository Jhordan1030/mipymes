<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEstado;

class TipoEstadoController extends Controller
{
    public function index()
    {
        $tipoEstados = TipoEstado::orderBy('id_estado', 'DESC')->paginate(5);
        return view('tipo_estado.index', compact('tipoEstados'));
    }

    public function create()
    {
        return view('tipo_estado.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_estado' => 'required|max:254',
            'descripcion_estado' => 'required|max:254',
        ]);

        TipoEstado::create($request->all());
        return redirect()->route('tipo_estado.index')->with('success', 'Tipo de estado creado con éxito.');
    }

    public function show($id_estado)
    {
        $tipoEstado = TipoEstado::findOrFail($id_estado);
        return view('tipo_estado.show', compact('tipoEstado'));
    }

    public function edit($id_estado)
    {
        $tipoEstado = TipoEstado::findOrFail($id_estado);
        return view('tipo_estado.edit', compact('tipoEstado'));
    }

    public function update(Request $request, $id_estado)
    {
        $request->validate([
            'nombre_estado' => 'required|max:254',
            'descripcion_estado' => 'required|max:254',
        ]);

        $tipoEstado = TipoEstado::findOrFail($id_estado);
        $tipoEstado->update($request->all());

        return redirect()->route('tipo_estado.index')->with('success', 'Tipo de estado actualizado con éxito.');
    }

    public function destroy($id_estado)
    {
        TipoEstado::findOrFail($id_estado)->delete();
        return redirect()->route('tipo_estado.index')->with('success', 'Tipo de estado eliminado con éxito.');
    }
}

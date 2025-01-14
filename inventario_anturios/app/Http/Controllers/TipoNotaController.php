<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoNota;

class TipoNotaController extends Controller
{
    public function index()
    {
        $tipoNotas = TipoNota::orderBy('idtiponota', 'DESC')->paginate(5);
        return view('tipoNota.index', compact('tipoNotas'));
    }

    public function create()
    {
        return view('tipoNota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tiponota' => 'required|max:10',
            'responsable' => 'required|max:20',
            'fechanota' => 'required|date',
            'detalle' => 'required|max:50',
            'responsableentrega' => 'required|max:20',
            'fechaentrega' => 'required|date',
        ]);

        TipoNota::create($request->all());
        return redirect()->route('tipoNota.index')->with('success', 'Registro creado satisfactoriamente.');
    }

    public function edit($id)
    {
        $tipoNota = TipoNota::findOrFail($id);
        return view('tipoNota.edit', compact('tipoNota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tiponota' => 'required|max:10',
            'responsable' => 'required|max:20',
            'fechanota' => 'required|date',
            'detalle' => 'required|max:50',
            'responsableentrega' => 'required|max:20',
            'fechaentrega' => 'required|date',
        ]);

        $tipoNota = TipoNota::findOrFail($id);
        $tipoNota->update($request->all());
        return redirect()->route('tipoNota.index')->with('success', 'Registro actualizado satisfactoriamente.');
    }

    public function destroy($id)
    {
        $tipoNota = TipoNota::findOrFail($id);
        $tipoNota->delete();
        return redirect()->route('tipoNota.index')->with('success', 'Registro eliminado satisfactoriamente.');
    }
}

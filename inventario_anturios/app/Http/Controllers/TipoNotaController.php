<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoNota;
use App\Models\Empleado;

class TipoNotaController extends Controller
{
    public function index()
    {
        $tipoNotas = TipoNota::with(['responsableEmpleado', 'responsableEntregaEmpleado'])->orderBy('idtiponota', 'DESC')->paginate(5);
        return view('tipoNota.index', compact('tipoNotas'));
    }

    public function create()
    {
        $empleados = Empleado::all(); // Obtener todos los empleados
        return view('tipoNota.create', compact('empleados'));
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
        $tipoNota = TipoNota::with(['responsableEmpleado', 'responsableEntregaEmpleado'])->findOrFail($id);
        $empleados = Empleado::all(); // Para el dropdown
        return view('tipoNota.edit', compact('tipoNota', 'empleados'));
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

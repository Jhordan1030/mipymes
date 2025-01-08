<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoCuenta;

class EstadoCuentaController extends Controller
{
    public function index()
    {
        $estado_cuentas = EstadoCuenta::orderBy('idestadocuenta', 'DESC')->paginate(3);
        return view('estado_cuenta.index', compact('estado_cuentas'));
    }

    public function create()
    {
        return view('estado_cuenta.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreestadocuenta' => 'required|max:255',
            'descripcionestadocuenta' => 'required|max:500',
        ]);

        EstadoCuenta::create($request->only(['nombreestadocuenta', 'descripcionestadocuenta']));

        return redirect()->route('estado_cuenta.index')->with('success', 'Estado de cuenta creado satisfactoriamente');
    }

    public function show(string $id)
    {
        $estado_cuenta = EstadoCuenta::findOrFail($id);
        return view('estado_cuenta.show', compact('estado_cuenta'));
    }

    public function edit(string $id)
    {
        $estado_cuenta = EstadoCuenta::findOrFail($id);
        return view('estado_cuenta.edit', compact('estado_cuenta'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombreestadocuenta' => 'required|max:255',
            'descripcionestadocuenta' => 'required|max:500',
        ]);

        $estado_cuenta = EstadoCuenta::findOrFail($id);
        $estado_cuenta->update($request->only(['nombreestadocuenta', 'descripcionestadocuenta']));

        return redirect()->route('estado_cuenta.index')->with('success', 'Estado de cuenta actualizado satisfactoriamente');
    }

    public function destroy(string $id)
    {
        $estado_cuenta = EstadoCuenta::findOrFail($id);
        $estado_cuenta->delete();

        return redirect()->route('estado_cuenta.index')->with('success', 'Estado de cuenta eliminado satisfactoriamente');
    }
}

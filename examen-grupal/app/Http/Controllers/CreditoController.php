<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\EstadoCuenta;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function index()
    {
        $creditos = Credito::with(['cliente', 'empleado', 'estadocuenta'])->paginate(10);
        return view('credito.index', compact('creditos'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        //$clientes = Cliente::all();
        //$estados = EstadoCuenta::all();
        return view('credito.create', compact('empleados', 'clientes', 'estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idcliente' => 'required|exists:clientes,id',
            'idestadocuenta' => 'nullable|exists:estadocuenta,id',
            'idempleadocredito' => 'required|exists:empleados,id',
            'valorcredito' => 'required|numeric',
            'fechacredito' => 'required|date',
            'descripcioncredito' => 'required|string|max:254',
        ]);

        Credito::create($request->all());
        return redirect()->route('credito.index')->with('success', 'Crédito creado exitosamente.');
    }

    public function edit(Credito $credito)
    {
        $empleados = Empleado::all();
        //$clientes = Cliente::all();
        //$estados = EstadoCuenta::all();
        return view('credito.edit', compact('credito', 'empleados', 'clientes', 'estados'));
    }

    public function update(Request $request, Credito $credito)
    {
        $request->validate([
            'idcliente' => 'required|exists:clientes,id',
            'idestadocuenta' => 'nullable|exists:estadocuenta,id',
            'idempleadocredito' => 'required|exists:empleados,id',
            'valorcredito' => 'required|numeric',
            'fechacredito' => 'required|date',
            'descripcioncredito' => 'required|string|max:254',
        ]);

        $credito->update($request->all());
        return redirect()->route('credito.index')->with('success', 'Crédito actualizado exitosamente.');
    }

    public function destroy(Credito $credito)
    {
        $credito->delete();
        return redirect()->route('credito.index')->with('success', 'Crédito eliminado exitosamente.');
    }
}

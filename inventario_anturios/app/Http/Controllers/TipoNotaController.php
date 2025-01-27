<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;
use App\Models\TipoNota;
use App\Models\Empleado;
use App\Models\Producto;

class TipoNotaController extends Controller
{
    public function index()
    {
        $tipoNotas = TipoNota::with(['responsableEmpleado', 'producto', 'bodega'])->orderBy('idtiponota', 'DESC')->paginate(5);
        return view('tipoNota.index', compact('tipoNotas'));
    }

    public function create()
    {
        $tipoempaques = \App\Models\TipoEmpaque::all();
        $empleados = Empleado::all();
        $productos = Producto::all();
        $bodegas = Bodega::all();
        return view('tipoNota.create', compact('empleados', 'productos', 'bodegas', 'tipoempaques'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tiponota' => 'required|in:ENVIO,DEVOLUCION',
            'responsable' => 'required|integer|exists:empleados,idempleado',
            'codigoproducto' => 'required|array|min:1',
            'codigoproducto.*' => 'required|string|exists:productos,codigo',
            'cantidad' => 'required|array|min:1',
            'cantidad.*' => 'required|integer|min:1',
            'codigotipoempaque' => 'required|array|min:1',
            'codigotipoempaque.*' => 'required|string|exists:tipoempaques,codigotipoempaque',
            'idbodega' => 'required|string|exists:bodegas,idbodega',
            'fechanota' => 'required|date',
        ]);

        foreach ($request->codigoproducto as $index => $codigoProducto) {
            TipoNota::create([
                'tiponota' => $request->tiponota,
                'responsable' => $request->responsable,
                'codigoproducto' => $codigoProducto,
                'cantidad' => $request->cantidad[$index],
                'codigotipoempaque' => $request->codigotipoempaque[$index],
                'idbodega' => $request->idbodega,
                'fechanota' => $request->fechanota,
            ]);
        }

        return redirect()->route('tipoNota.index')->with('success', 'Nota creada correctamente.');
    }

    public function edit($id)
    {
        $tipoNota = TipoNota::with(['responsableEmpleado', 'bodega'])->findOrFail($id);
        $empleados = Empleado::all();
        $productos = Producto::all();
        $bodegas = Bodega::all();
        $tipoempaques = \App\Models\TipoEmpaque::all();
        return view('tipoNota.edit', compact('tipoNota', 'empleados', 'productos', 'bodegas', 'tipoempaques'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tiponota' => 'required|in:ENVIO,DEVOLUCION',
            'responsable' => 'required|integer|exists:empleados,idempleado',
            'codigoproducto' => 'nullable|string|exists:productos,codigo',
            'cantidad' => 'nullable|integer|min:1',
            'codigotipoempaque' => 'nullable|string|exists:tipoempaques,codigotipoempaque',
            'idbodega' => 'required|string|exists:bodegas,idbodega',
            'fechanota' => 'required|date',
        ]);

        $tipoNota = TipoNota::findOrFail($id);
        $tipoNota->update($request->all());

        return redirect()->route('tipoNota.index')->with('success', 'Nota actualizada correctamente.');
    }

    public function destroy($id)
    {
        $tipoNota = TipoNota::findOrFail($id);
        $tipoNota->delete();
        return redirect()->route('tipoNota.index')->with('success', 'Nota eliminada correctamente.');
    }
}

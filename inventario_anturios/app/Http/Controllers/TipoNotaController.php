<?php

namespace App\Http\Controllers;

use App\Models\TipoNota;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Bodega;
use App\Models\TipoEmpaque;
use Illuminate\Http\Request;

class TipoNotaController extends Controller
{
    public function index()
    {
        $tipoNotas = TipoNota::with(['responsableEmpleado', 'bodega', 'producto', 'tipoEmpaque'])
            ->orderBy('idtiponota', 'DESC')
            ->paginate(5);

        return view('tipoNota.index', compact('tipoNotas'));
    }

    public function create()
    {
        $tipoempaques = TipoEmpaque::all();
        $empleados = Empleado::all();
        $productos = Producto::all();
        $bodegas = Bodega::all();
        return view('tipoNota.create', compact('empleados', 'productos', 'bodegas', 'tipoempaques'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tiponota' => 'required|in:ENVIO,DEVOLUCION',
            'idempleado' => 'required|integer|exists:empleados,idempleado',
            'codigoproducto' => 'required|array|min:1',
            'codigoproducto.*' => 'required|string|exists:productos,codigo',
            'cantidad' => 'required|array|min:1',
            'cantidad.*' => 'required|integer|min:1',
            'codigotipoempaque' => 'required|array|min:1',
            'codigotipoempaque.*' => 'required|string|exists:tipoempaques,codigotipoempaque',
            'idbodega' => 'required|string|exists:bodegas,idbodega',
        ]);

        foreach ($request->codigoproducto as $index => $codigoProducto) {
            TipoNota::create([
                'tiponota' => $request->tiponota,
                'idempleado' => $request->idempleado,
                'codigoproducto' => $codigoProducto,
                'cantidad' => $request->cantidad[$index],
                'codigotipoempaque' => $request->codigotipoempaque[$index],
                'idbodega' => $request->idbodega,
                'fechanota' => now(),
            ]);
        }

        return redirect()->route('tipoNota.index')->with('success', 'Nota creada correctamente.');
    }

    public function edit($id)
    {
        $tipoNota = TipoNota::findOrFail($id);
        $tipoempaques = TipoEmpaque::all();
        $empleados = Empleado::all();
        $productos = Producto::all();
        $bodegas = Bodega::all();

        return view('tipoNota.edit', compact('tipoNota', 'empleados', 'productos', 'bodegas', 'tipoempaques'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tiponota' => 'required|in:ENVIO,DEVOLUCION',
            'idempleado' => 'required|integer|exists:empleados,idempleado',
            'codigoproducto' => 'required|string|exists:productos,codigo',
            'cantidad' => 'required|integer|min:1',
            'codigotipoempaque' => 'required|string|exists:tipoempaques,codigotipoempaque',
            'idbodega' => 'required|string|exists:bodegas,idbodega',
        ]);

        $tipoNota = TipoNota::findOrFail($id);

        // Actualiza los valores directamente sin eliminar el registro
        $tipoNota->update([
            'tiponota' => $request->tiponota,
            'idempleado' => $request->idempleado,
            'codigoproducto' => $request->codigoproducto,
            'cantidad' => $request->cantidad,
            'codigotipoempaque' => $request->codigotipoempaque,
            'idbodega' => $request->idbodega,
            'fechanota' => $tipoNota->fechanota, // Mantiene la fecha original
        ]);

        return redirect()->route('tipoNota.index')->with('success', 'Nota actualizada correctamente.');
    }


    public function destroy($id)
    {
        // Buscar la nota por su ID
        $tipoNota = TipoNota::find($id);

        // Verificar si la nota existe
        if (!$tipoNota) {
            return redirect()->route('tipoNota.index')->with('error', 'Tipo de Nota no encontrado.');
        }

        // Eliminar la nota
        $tipoNota->delete();

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('tipoNota.index')->with('success', 'Tipo de Nota eliminada correctamente.');
    }
}

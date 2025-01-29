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

    public function edit($id)
    {
        $tipoNota = TipoNota::findOrFail($id);
        $tipoempaques = TipoEmpaque::all();
        $empleados = Empleado::all();
        $productos = Producto::all();
        $bodegas = Bodega::all();

        return view('tipoNota.edit', compact('tipoNota', 'empleados', 'productos', 'bodegas', 'tipoempaques'));
    }

    public function create()
    {
        $tipoempaques = TipoEmpaque::all();
        $empleados = Empleado::all();
        $productos = Producto::all();
        $bodegas = Bodega::all();

        $ultimoCodigo = TipoNota::latest()->first();
        $numero = $ultimoCodigo ? (int) substr($ultimoCodigo->codigo, -3) + 1 : 1;
        $codigoNota = sprintf('TN-%03d', $numero);

        return view('tipoNota.create', compact('empleados', 'productos', 'bodegas', 'tipoempaques', 'codigoNota'));
    }

    public function destroy($id)
    {
        $tipoNota = TipoNota::findOrFail($id);
        $tipoNota->delete();

        return redirect()->route('tipoNota.index')->with('success', 'Tipo de Nota eliminada correctamente.');
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
        $tipoNota->update($request->all());

        return redirect()->route('tipoNota.index')->with('success', 'Nota actualizada correctamente.');
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

        $ultimoCodigo = TipoNota::latest()->first();
        $numero = $ultimoCodigo ? (int) substr($ultimoCodigo->codigo, -3) + 1 : 1;
        $letras = range('A', 'Z');

        foreach ($request->codigoproducto as $index => $codigoProducto) {
            $codigoGenerado = count($request->codigoproducto) > 1 ? 'TN' . $letras[$index] . '-' . sprintf('%03d', $numero) : sprintf('TN-%03d', $numero);
            TipoNota::create([
                'codigo' => $codigoGenerado,
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
}

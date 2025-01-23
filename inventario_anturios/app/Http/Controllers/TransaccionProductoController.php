<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaccionProducto;
use App\Models\Producto;
use App\Models\Bodega;
use App\Models\Empleado;

class TransaccionProductoController extends Controller
{
    public function index()
    {
        $transacciones = TransaccionProducto::with(['producto', 'bodega', 'empleado'])
            ->orderBy('idtransaccion', 'DESC')
            ->paginate(10);

        return view('transaccion_producto.index', compact('transacciones'));
    }

    public function create()
    {
        $productos = Producto::all();
        $bodegas = Bodega::all();
        $empleados = Empleado::all();

        return view('transaccion_producto.create', compact('productos', 'bodegas', 'empleados'));
    }

    public function store(Request $request)
    {
       // dd($request->all());

        $request->validate([
            'tipotransaccion' => 'required|string|in:envío,devolución',
            'codigoproducto' => 'required|array|min:1',
            'codigoproducto.*' => 'required|string|exists:productos,codigo',
            'cantidad' => 'required|array|min:1',
            'cantidad.*' => 'required|integer|min:1',
            'idbodega' => 'required|string|exists:bodegas,idbodega',
            'idempleado' => 'required|integer|exists:empleados,idempleado',
        ]);

        foreach ($request->codigoproducto as $index => $codigoProducto) {
            TransaccionProducto::create([
                'tipotransaccion' => $request->tipotransaccion,
                'codigoproducto' => $codigoProducto,
                'cantidad' => $request->cantidad[$index],
                'idbodega' => $request->idbodega,
                'idempleado' => $request->idempleado,
            ]);
        }

        return redirect()->route('transaccion_producto.index')->with('success', 'Transacción creada exitosamente.');
    }

    public function edit($idtransaccion)
    {
        $transaccion = TransaccionProducto::findOrFail($idtransaccion);
        $productos = Producto::all();
        $bodegas = Bodega::all();
        $empleados = Empleado::all();

        return view('transaccion_producto.edit', compact('transaccion', 'productos', 'bodegas', 'empleados'));
    }

    public function update(Request $request, $idtransaccion)
    {
        $request->validate([
            'tipotransaccion' => 'required|string|in:envío,devolución',
            'codigoproducto' => 'nullable|string|exists:productos,codigo',
            'cantidad' => 'nullable|integer|min:1',
            'idbodega' => 'required|integer|exists:bodegas,idbodega',
            'idempleado' => 'required|integer|exists:empleados,idempleado',
        ]);

        $transaccion = TransaccionProducto::findOrFail($idtransaccion);
        $transaccion->update($request->all());

        return redirect()->route('transaccion_producto.index')->with('success', 'Transacción actualizada exitosamente.');
    }

    public function destroy($idtransaccion)
    {
        TransaccionProducto::findOrFail($idtransaccion)->delete();

        return redirect()->route('transaccion_producto.index')->with('success', 'Transacción eliminada exitosamente.');
    }
}

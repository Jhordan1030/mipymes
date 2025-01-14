<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaccionProducto;

class TransaccionProductoController extends Controller
{
    public function index()
    {
        $transacciones = TransaccionProducto::orderBy('idtransaccion', 'DESC')->paginate(10);
        return view('transaccion_producto.index', compact('transacciones'));
    }

    public function create()
    {
        return view('transaccion_producto.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipotransaccion' => 'required|max:20',
            'cantidad' => 'required|integer|min:1',
            'estadodisponibilidad' => 'required|max:10',
            'estadoproducto' => 'required|max:10',
        ]);

        TransaccionProducto::create($request->all());

        return redirect()->route('transaccion_producto.index')->with('success', 'Transacción creada exitosamente.');
    }

    public function edit($idtransaccion)
    {
        $transaccion = TransaccionProducto::findOrFail($idtransaccion);
        return view('transaccion_producto.edit', compact('transaccion'));
    }

    public function update(Request $request, $idtransaccion)
    {
        $request->validate([
            'tipotransaccion' => 'required|max:20',
            'cantidad' => 'required|integer|min:1',
            'estadodisponibilidad' => 'required|max:10',
            'estadoproducto' => 'required|max:10',
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

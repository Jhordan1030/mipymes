<?php

namespace App\Http\Controllers;

use App\Models\DetalleProducto;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleProductoController extends Controller
{
    public function index()
    {
        $detalleProductos = DetalleProducto::with('producto')->paginate(5);
        return view('detalleproducto.index', compact('detalleProductos'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('detalleproducto.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idproducto' => 'nullable|exists:producto,idproducto',
            'especificacionesproducto' => 'required|string|max:254',
            'preciodetalleproducto' => 'required|numeric',
            'fechaingresodetalleproducto' => 'required|date',
        ]);

        DetalleProducto::create($validated);

        return redirect()->route('detalleproducto.index')->with('success', 'Detalle de producto creado correctamente.');
    }

    public function edit($id)
    {
        $detalleProducto = DetalleProducto::findOrFail($id);
        $productos = Producto::all();
        return view('detalleproducto.edit', compact('detalleProducto', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'idproducto' => 'nullable|exists:producto,idproducto',
            'especificacionesproducto' => 'required|string|max:254',
            'preciodetalleproducto' => 'required|numeric',
            'fechaingresodetalleproducto' => 'required|date',
        ]);

        $detalleProducto = DetalleProducto::findOrFail($id);
        $detalleProducto->update($validated);

        return redirect()->route('detalleproducto.index')->with('success', 'Detalle de producto actualizado satisfactoriamente.');
    }

    public function destroy($id)
    {
        $detalleProducto = DetalleProducto::findOrFail($id);
        $detalleProducto->delete();

        return redirect()->route('detalleproducto.index')->with('success', 'Detalle de producto eliminado satisfactoriamente.');
    }
}


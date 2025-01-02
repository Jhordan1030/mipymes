<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\TipoEmpaque;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('tipoEmpaque')->paginate(5);
        return view('producto.index', compact('productos'));
    }

    public function create()
    {
        $tipoEmpaques = TipoEmpaque::all();
        return view('producto.create', compact('tipoEmpaques'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombreproducto' => 'required|string|max:255',
            'descripcionproducto' => 'nullable|string',
            'cantidadminimaproducto' => 'required|numeric',
            'cantidadmaximaproducto' => 'required|numeric',
            'id_tipo__empaque' => 'nullable|exists:tipo__empaque,id_tipo__empaque',
        ]);

        Producto::create($validated);

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $tipoEmpaques = TipoEmpaque::all();
        return view('producto.edit', compact('producto', 'tipoEmpaques'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombreproducto' => 'required|string|max:255',
            'descripcionproducto' => 'nullable|string',
            'cantidadminimaproducto' => 'required|numeric',
            'cantidadmaximaproducto' => 'required|numeric',
            'id_tipo__empaque' => 'nullable|exists:tipo__empaque,id_tipo__empaque',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($validated);

        return redirect()->route('producto.index')->with('success', 'Producto actualizado satisfactoriamente.');
    }


    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('producto.index')->with('success', 'Producto eliminado satisfactoriamente.');
    }
}

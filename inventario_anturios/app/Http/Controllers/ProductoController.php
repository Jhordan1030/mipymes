<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\TipoEmpaque;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();

        // Filtrar por nombre si se proporciona
        if ($request->filled('search')) {
            $query->where('nombreprod', 'like', '%' . $request->search . '%');
        }

        // Obtener productos con paginación
        $productos = $query->orderBy('nombreprod', 'ASC')->paginate(5);

        return view('producto.index', compact('productos'));
    }

    public function create()
    {
        // Obtener los tipos de empaque disponibles
        $tipoempaques = TipoEmpaque::all();
        return view('producto.create', compact('tipoempaques'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idtipoempaque' => 'nullable|integer|exists:tipoempaques,idtipoempaque',
            'nombreprod' => 'required|string|max:10',
            'descripcionprod' => 'required|string|max:30',
            'precio' => 'required|numeric|min:0',
            'estadodisponibilidad' => 'required|string|max:20',
            'cantidadmin' => 'required|integer|min:1',
        ]);

        Producto::create($validatedData);

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($idproducto)
    {
        $producto = Producto::findOrFail($idproducto);
        $tipoempaques = TipoEmpaque::all();

        return view('producto.edit', compact('producto', 'tipoempaques'));
    }

    public function update(Request $request, $idproducto)
    {
        $validatedData = $request->validate([
            'idtipoempaque' => 'nullable|integer|exists:tipoempaques,idtipoempaque',
            'nombreprod' => 'required|string|max:10',
            'descripcionprod' => 'required|string|max:30',
            'precio' => 'required|numeric|min:0',
            'estadodisponibilidad' => 'required|string|max:20',
            'cantidadmin' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($idproducto);
        $producto->update($validatedData);

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($idproducto)
    {
        $producto = Producto::findOrFail($idproducto);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }
}

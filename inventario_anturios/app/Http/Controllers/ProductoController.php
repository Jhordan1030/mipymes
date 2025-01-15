<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra una lista de productos.
     */
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

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        return view('producto.create');
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idtipoempaque' => 'nullable|integer|exists:tipo_empaques,id',
            'nombreprod' => 'required|string|max:10',
            'descripcionprod' => 'required|string|max:30',
            'precio' => 'required|numeric|min:0',
            'estadodisponibilidad' => 'required|string|max:10',
            'cantidadmin' => 'required|integer|min:1',
        ]);

        Producto::create($validatedData);

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Muestra los detalles de un producto específico.
     */
    public function show($idproducto)
    {
        $producto = Producto::findOrFail($idproducto);

        return view('producto.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function edit($idproducto)
    {
        $producto = Producto::findOrFail($idproducto);

        return view('producto.edit', compact('producto'));
    }

    /**
     * Actualiza un producto existente en la base de datos.
     */
    public function update(Request $request, $idproducto)
    {
        $validatedData = $request->validate([
            'idtipoempaque' => 'nullable|integer|exists:tipo_empaques,id',
            'nombreprod' => 'required|string|max:10',
            'descripcionprod' => 'required|string|max:30',
            'precio' => 'required|numeric|min:0',
            'estadodisponibilidad' => 'required|string|max:10',
            'cantidadmin' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($idproducto);
        $producto->update($validatedData);

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina un producto de la base de datos.
     */
    public function destroy($idproducto)
    {
        $producto = Producto::findOrFail($idproducto);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }
}

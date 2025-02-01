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

        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        $productos = $query->orderBy('nombre', 'ASC')->paginate(5);

        return view('producto.index', compact('productos'));
    }



    public function create()
    {
        // Obtenemos todos los registros de tipoempaques
        $tipoempaques = \App\Models\TipoEmpaque::all();

        // Pasamos los datos a la vista
        return view('producto.create', compact('tipoempaques'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:10|unique:productos,codigo',
            'nombre' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|unique:productos,nombre|max:50',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:1',
            'codigotipoempaque' => 'nullable|exists:tipoempaques,codigotipoempaque'
        ], [
            'nombre.regex' => 'El nombre del producto solo puede contener letras y espacios.',
            'nombre.unique' => 'El nombre del producto ya existe en la base de datos.'
        ]);

        Producto::create($request->all());

        return redirect()->route('producto.index')->with('success', 'Producto creado con éxito.');
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'codigo' => "required|string|max:10|unique:productos,codigo,$id,id",
            'nombre' => "required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/|unique:productos,nombre,$id,id|max:50",
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:1',
            'codigotipoempaque' => 'nullable|exists:tipoempaques,codigotipoempaque'
        ], [
            'nombre.regex' => 'El nombre del producto solo puede contener letras y espacios.',
            'nombre.unique' => 'El nombre del producto ya existe en la base de datos.'
        ]);

        $producto->update($request->all());

        return redirect()->route('producto.index')->with('success', 'Producto actualizado con éxito.');
    }


    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $tipoempaques = TipoEmpaque::all();

        return view('producto.edit', compact('producto', 'tipoempaques'));
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }
}

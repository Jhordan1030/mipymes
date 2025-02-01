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
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:10|unique:productos,codigo',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'codigotipoempaque' => 'nullable|string|exists:tipoempaques,codigotipoempaque',
        ]);

        Producto::create($validatedData);

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $tipoempaques = TipoEmpaque::all();

        return view('producto.edit', compact('producto', 'tipoempaques'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:10|unique:productos,codigo,' . $id,
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'codigotipoempaque' => 'nullable|string|exists:tipoempaques,codigotipoempaque',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($validatedData);

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }
}

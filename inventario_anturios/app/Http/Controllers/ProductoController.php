<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Asegúrate de importar esto

class ProductoController extends Controller
{

      //Autoriza las acciones del controllador realcionadas con el modelo producto
    
      use AuthorizesRequests; 
      public function __construct()
  {
      //Se aplica la política 
      $this->authorizeResource(Producto::class, 'producto'); //Autoriza los recursos del modelo producto
  }
 
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
        // Definir las opciones de tipo de empaque directamente
        $tipoempaques = ['Paquete', 'Caja', 'Unidad'];

        return view('producto.create', compact('tipoempaques'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:10|unique:productos,codigo',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'tipoempaque' => 'nullable|in:Paquete,Caja,Unidad', // Validar las opciones permitidas
        ]);

        Producto::create($validatedData);

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        // Definir las opciones de tipo de empaque directamente
        $tipoempaques = ['Paquete', 'Caja', 'Unidad'];

        return view('producto.edit', compact('producto', 'tipoempaques'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:10|unique:productos,codigo,' . $id,
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'tipoempaque' => 'nullable|in:Paquete,Caja,Unidad', // Validar las opciones permitidas
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

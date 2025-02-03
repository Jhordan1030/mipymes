<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Asegúrate de importar esto
use Illuminate\Support\Facades\DB;

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
        // Validar los datos antes de insertarlos, incluyendo la validación de cantidad
        $validatedData = $request->validate([
            'codigo' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'cantidad' => 'required|integer|min:1', // Aseguramos que la cantidad sea un número entero y mayor a 0
            'tipoempaque' => 'nullable|in:Paquete,Caja,Unidad',
        ]);

        // Verificar si la cantidad es negativa y mostrar un mensaje de error
        if ($request->cantidad < 1) {
            return redirect()->back()->withInput()->with('error', 'No se puede ingresar cantidades negativas');
        }

        try {
            // Insertando directamente para que active el trigger
            DB::insert("INSERT INTO productos (codigo, nombre, descripcion, cantidad, tipoempaque, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())", [
                $validatedData['codigo'],
                $validatedData['nombre'],
                $validatedData['descripcion'],
                $request->cantidad,
                $validatedData['tipoempaque']
            ]);

            return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = $e->getMessage();

            // Extraer solo el mensaje del trigger
            if (strpos($errorMessage, 'El código del producto ya existe.') !== false) {
                return redirect()->back()->withInput()->with('error', 'El código del producto ya existe.');
            }

            return redirect()->back()->withInput()->with('error', 'Error al crear el producto.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validar los datos antes de actualizarlos
        $validatedData = $request->validate([
            'codigo' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'cantidad' => 'required|integer|min:1', // Aseguramos que la cantidad sea un número entero y mayor a 0
            'tipoempaque' => 'nullable|in:Paquete,Caja,Unidad',
        ]);

        // Verificar si la cantidad es negativa y mostrar un mensaje de error
        if ($request->cantidad < 1) {
            return redirect()->back()->withInput()->with('error', 'No se puede ingresar cantidades negativas');
        }

        try {
            // Buscar el producto y actualizar sus datos
            $producto = Producto::findOrFail($id);
            $producto->update([
                'codigo' => $validatedData['codigo'],
                'nombre' => $validatedData['nombre'],
                'descripcion' => $validatedData['descripcion'],
                'cantidad' => $validatedData['cantidad'],
                'tipoempaque' => $validatedData['tipoempaque']
            ]);

            return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = $e->getMessage();

            // Extraer solo el mensaje del trigger
            if (strpos($errorMessage, 'El código del producto ya existe.') !== false) {
                return redirect()->back()->withInput()->with('error', 'El código del producto ya existe.');
            }

            return redirect()->back()->withInput()->with('error', 'Error al actualizar el producto.');
        }
    }




    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $tipoempaques = ['Paquete', 'Caja', 'Unidad'];

        return view('producto.edit', compact('producto', 'tipoempaques'));
    }


    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class ProductoController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Producto::class, 'producto');
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
        $tipoempaques = ['Paquete', 'Caja', 'Unidad'];
        return view('producto.create', compact('tipoempaques'));
    }

    public function store(Request $request)
    {
        // Validaciones de Laravel
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:10',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string',
            'cantidad' => 'required|integer|min:1',
            'tipoempaque' => 'nullable|in:Paquete,Caja,Unidad',
        ]);

        try {
            // Inserción en la base de datos, activando el trigger
            DB::insert("
                INSERT INTO productos (codigo, nombre, descripcion, cantidad, tipoempaque, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, NOW(), NOW())
            ", [
                $validatedData['codigo'],
                $validatedData['nombre'],
                $validatedData['descripcion'],
                $validatedData['cantidad'],
                $validatedData['tipoempaque']
            ]);

            return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
        } catch (QueryException $e) {
            return $this->handleDatabaseException($e);
        }
    }

    public function update(Request $request, $id)
    {
        // Validaciones de Laravel
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:10',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string',
            'cantidad' => 'required|integer|min:1',
            'tipoempaque' => 'nullable|in:Paquete,Caja,Unidad',
        ]);

        try {
            // Buscar producto y actualizar
            $producto = Producto::findOrFail($id);
            $producto->update($validatedData);

            return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
        } catch (QueryException $e) {
            return $this->handleDatabaseException($e);
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

    /**
     * Manejo de errores de la base de datos (PostgreSQL)
     */
    private function handleDatabaseException(QueryException $e)
    {
        $errorMessage = $e->getMessage();

        // Detectar errores del trigger PostgreSQL y mostrarlos al usuario
        if (strpos($errorMessage, 'El código del producto ya existe.') !== false) {
            return redirect()->back()->withInput()->with('error', 'El código del producto ya está en uso.');
        }

        if (strpos($errorMessage, 'El nombre del producto solo puede contener letras y espacios.') !== false) {
            return redirect()->back()->withInput()->with('error', 'El nombre del producto solo puede contener letras y espacios.');
        }

        if (strpos($errorMessage, 'La cantidad no puede ser negativa.') !== false) {
            return redirect()->back()->withInput()->with('error', 'No se pueden ingresar cantidades negativas.');
        }

        if (strpos($errorMessage, 'Todos los campos obligatorios deben estar llenos.') !== false) {
            return redirect()->back()->withInput()->with('error', 'Todos los campos son obligatorios.');
        }

        return redirect()->back()->withInput()->with('error', 'Error inesperado en la base de datos.');
    }
}

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

    /**
     * Muestra la lista de productos con búsqueda y paginación.
     */
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        $productos = $query->orderBy('nombre', 'ASC')->paginate(5);

        return view('producto.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        $tipoempaques = ['Paquete', 'Caja', 'Unidad'];
        return view('producto.create', compact('tipoempaques'));
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        // Validaciones en Laravel antes de la inserción
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:10',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string',
            'cantidad' => 'required|integer|min:1',
            'tipoempaque' => 'nullable|in:Paquete,Caja,Unidad',
        ]);

        try {
            // Inserción en la base de datos para activar el trigger
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

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $tipoempaques = ['Paquete', 'Caja', 'Unidad'];
        return view('producto.edit', compact('producto', 'tipoempaques'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:10',
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string',
            'cantidad' => 'required|integer|min:1',
            'tipoempaque' => 'nullable|in:Paquete,Caja,Unidad',
        ]);

        try {
            $producto = Producto::findOrFail($id);
            $producto->update($validatedData);

            return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
        } catch (QueryException $e) {
            return $this->handleDatabaseException($e);
        }
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }

    /**
     * Captura automáticamente los errores del trigger PostgreSQL y los muestra en Laravel.
     */
    private function handleDatabaseException(QueryException $e)
    {
        $errorMessage = $e->getMessage();

        // Extraer el mensaje exacto del trigger PostgreSQL
        if (preg_match("/ERROR:\s(.*?)\sCONTEXT:/", $errorMessage, $matches)) {
            return redirect()->back()->withInput()->with('error', trim($matches[1]));
        }

        return redirect()->back()->withInput()->with('error', 'Error inesperado en la base de datos.');
    }
}

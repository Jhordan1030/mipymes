<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los proveedores ordenados por ID en orden descendente y paginados
        $proveedores = Proveedor::orderBy('id', 'DESC')->paginate(3);

        // Retornar la vista 'proveedor.index' pasando los proveedores como datos
        return view('proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_proveedor' => 'required',
            'descripcion_proveedor' => 'required',
            'direccion_proveedor' => 'required',
            'telefono_proveedor' => 'required',
        ]);
        Proveedor::create($request->all());
        return redirect()->route('proveedor.index')->with('success', 'Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proveedores = Proveedor::find($id);
        return  view('proveedor.show', compact('proveedores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener los proveedores y paginarlos
        $proveedor = Proveedor::find($id);

        // Retornar la vista con los proveedores
        return view('proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los campos del libro
        $request->validate([
            'nombre_proveedor' => 'required',
            'descripcion_proveedor' => 'required',
            'direccion_proveedor' => 'required',
            'telefono_proveedor' => 'required'

        ]);

        // Buscar el libro por su ID
        $proveedor = Proveedor::find($id);

        // Actualizar los campos del libro con los datos del request
        $proveedor->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('proveedor.index')->with('success', 'Proveedor actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proveedor = Proveedor::find($id)->delete();
        return redirect()->route('proveedor.index')->with('success', 'Registro eliminado');
    }
}

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
        // Cambia 'id' a 'idproveedor'
        $proveedores = Proveedor::orderBy('idproveedor', 'DESC')->paginate(3);

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
    public function show(string $idproveedor)
    {
        // Cambia 'id' a 'idproveedor'
        $proveedores = Proveedor::find($idproveedor);

        return view('proveedor.show', compact('proveedores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idproveedor)
    {
        // Cambia 'id' a 'idproveedor'
        $proveedor = Proveedor::find($idproveedor);

        return view('proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idproveedor)
    {
        $request->validate([
            'nombre_proveedor' => 'required',
            'descripcion_proveedor' => 'required',
            'direccion_proveedor' => 'required',
            'telefono_proveedor' => 'required',
        ]);

        $proveedor = Proveedor::find($idproveedor);
        $proveedor->update($request->all());

        return redirect()->route('proveedor.index')->with('success', 'Proveedor actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idproveedor)
    {
        Proveedor::find($idproveedor)->delete();

        return redirect()->route('proveedor.index')->with('success', 'Registro eliminado');
    }
}

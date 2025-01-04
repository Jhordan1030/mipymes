<?php

namespace App\Http\Controllers;

use App\Models\FacturaCompra;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class FacturaCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $factura_compras = FacturaCompra::with('proveedor')->paginate(10); // Obtener los datos paginados con la relación
        return view('factura_compra.index', compact('factura_compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('factura_compra.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idproveedor' => 'nullable|exists:proveedores,id',
            'fechafacturacompra' => 'required|date',
            'codigofacturacompra' => 'required|string|max:250',
            'totalfacturacompra' => 'required|numeric'
        ]);

        FacturaCompra::create($request->all());
        return redirect()->route('factura_compra.index')->with('success', 'Factura de compra creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('factura_compra.show', compact('factura_compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $factura_compra = FacturaCompra::findOrFail($id); // Encuentra la factura por su ID
        $proveedores = Proveedor::all(); // Obtén todos los proveedores disponibles
    
        return view('factura_compra.edit', compact('factura_compra', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'idproveedor' => 'nullable|exists:proveedores,id',
            'fechafacturacompra' => 'required|date',
            'codigofacturacompra' => 'required|string|max:250',
            'totalfacturacompra' => 'required|numeric'
        ]);

        $factura_compra = FacturaCompra::find($id);
        $factura_compra->update($request->all());

        return redirect()->route('factura_compra.index')->with('success', 'Factura de compra actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $factura_compra = FacturaCompra::findOrfail($id);
        $factura_compra->delete();
        return redirect()->route('factura_compra.index')->with('success', 'Factura de compra eliminada correctamente');
    }
}

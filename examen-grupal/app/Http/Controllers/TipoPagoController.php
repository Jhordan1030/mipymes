<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoPago;

class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tpagos = TipoPago::orderBy('id', 'DESC')->paginate(3);
        return view('tpago.index', compact('tpagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tpago.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo_tipo_pago' => 'required',
            'nombre_tipo_pago' => 'required',
            'descripcion_tipo_pago' => 'required',
        ]);
        
        TipoPago::create($request->all());
    
        return redirect()->route('tpago.index')->with('success', 'Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tpagos = TipoPago::find($id);
        return view('tpago.show', compact('tpagos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tpago = TipoPago::find($id);
        return view('tpago.edit', compact('tpago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'codigo_tipo_pago' => 'required',
            'nombre_tipo_pago' => 'required',
            'descripcion_tipo_pago' => 'required'
        ]);

        $tpago = TipoPago::find($id);
        $tpago->update($request->all());
        return redirect()->route('tpago.index')->with('success', 'Tipo de pago actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TipoPago::find($id)->delete();
        return redirect()->route('tpago.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}

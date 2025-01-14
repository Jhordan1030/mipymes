<?php

namespace App\Http\Controllers;

use App\Models\TipoEmpaque;
use Illuminate\Http\Request;

class TipoEmpaquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoEmpaques = TipoEmpaque::orderBy('nombretipoempaque', 'DESC')->paginate(5);
        return view('tipoempaque.index', compact('tipoEmpaques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipoempaque.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombretipoempaque' => 'required',
            'codigotipoempaque' => 'required'
        ]);

        TipoEmpaque::create($request->all());
        return redirect()->route('tipoempaque.index')->with('success', 'Tipo de empaque creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idtipoempaque)
    {
        $idtipoempaque = TipoEmpaque::find($idtipoempaque);
        return view('tipoempaque.show', compact('idtipoempaque'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idtipoempaque)
    {
        $tipoempaque = TipoEmpaque::findOrFail($idtipoempaque);
        return view('tipoempaque.edit', compact('tipoempaque'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idtipoempaque)
    {
        $request->validate([
            'nombretipoempaque' => 'required',
            'codigotipoempaque' => 'required'
        ]);

        $tipoEmpaque = TipoEmpaque::find($idtipoempaque);
        $tipoEmpaque->update($request->all());
        return redirect()->route('tipoempaque.index')->with('success', 'Tipo de empaque actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idtipoempaque)
    {
        $tipoEmpaque = TipoEmpaque::find($idtipoempaque);
        $tipoEmpaque->delete();
        return redirect()->route('tipoempaque.index')->with('success', 'Tipo de empaque eliminado con éxito.');
    }
}

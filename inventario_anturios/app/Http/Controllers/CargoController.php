<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cargos = Cargo::orderBy('nombrecargo', 'DESC')->paginate(3);
        return view('cargo.index', compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cargo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigocargo' => 'required',
            'nombrecargo' => 'required|max:1024',
        ]);

        Cargo::create($request->all());
        return redirect()->route('cargo.index')->with('success', 'Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idcargo)
    {
        $cargo = Cargo::findOrFail($idcargo); // Cambia a findOrFail para manejar errores si no se encuentra
        return view('cargo.show', compact('cargo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idcargo)
    {
        $cargo = Cargo::findOrFail($idcargo); // Cambia a findOrFail para mayor seguridad
        return view('cargo.edit', compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idcargo)
    {
        $request->validate([
            'codigocargo' => 'required',
            'nombrecargo' => 'required|max:1024',
        ]);

        $cargo = Cargo::findOrFail($idcargo); // Cambia a findOrFail para manejar errores si no se encuentra
        $cargo->update($request->all());

        return redirect()->route('cargo.index')->with('success', 'Registro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idcargo)
    {
        Cargo::findOrFail($idcargo)->delete(); // Cambia a findOrFail para manejar errores si no se encuentra
        return redirect()->route('cargo.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}
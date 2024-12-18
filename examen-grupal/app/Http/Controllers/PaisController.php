<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = Pais::orderBy('id', 'DESC')->paginate(3);
        return view('pais.index', compact('paises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pais.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar que 'codigo_pais' no sea nulo
        $request->validate([
            'codigo_pais' => 'required',
            'nombre_pais' => 'required',
        ]);

        $pais = new Pais();
        $pais->codigo_pais = $request->codigo_pais;
        $pais->nombre_pais = $request->nombre_pais;
        $pais->save();

        return redirect()->route('pais.index')->with('success', 'Pais creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paises = Pais::find($id);
        return view('pais.show', compact('paises'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pais = pais::find($id);
        return view('pais.edit', compact('pais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los campos del libro
        $request->validate([
            'codigo_pais' => 'required',
            'nombre_pais' => 'required'
            
        ]);

        // Buscar el libro por su ID
        $pais = Pais::find($id);

        // Actualizar los campos del libro con los datos del request
        $pais->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('pais.index')->with('success', 'País actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pais::find($id)->delete();
        return redirect()->route('pais.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}

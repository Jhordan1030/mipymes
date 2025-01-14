<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoIdentificacion;

class TipoIdentificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoIdentificaciones = TipoIdentificacion::orderBy('nombreidentificacion', 'DESC')->paginate(5);
        return view('tipoidentificacion.index', compact('tipoIdentificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipoidentificacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombreidentificacion' => 'required'
        ]);

        TipoIdentificacion::create($request->all());
        return redirect()->route('tipoidentificacion.index')->with('success', 'Tipo de identificación creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ididentificacion)
    {
        $tipoIdentificacion = TipoIdentificacion::find($ididentificacion);
        return view('tipoidentificacion.show', compact('tipoIdentificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $ididentificacion)
    {
        // Buscar el registro por su clave primaria
        $tipoIdentificacion = TipoIdentificacion::findOrFail($ididentificacion);

        // Pasar el registro a la vista
        return view('tipoidentificacion.edit', compact('tipoIdentificacion'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $ididentificacion)
    {
        $request->validate([
            'nombreidentificacion' => 'required'
        ]);

        $tipoIdentificacion = TipoIdentificacion::find($ididentificacion);
        $tipoIdentificacion->update($request->all());
        return redirect()->route('tipoidentificacion.index')->with('success', 'Tipo de identificación actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $ididentificacion)
    {
        $tipoIdentificacion = TipoIdentificacion::find($ididentificacion);
        $tipoIdentificacion->delete();
        return redirect()->route('tipoidentificacion.index')->with('success', 'Tipo de identificación eliminado con éxito.');
    }
}

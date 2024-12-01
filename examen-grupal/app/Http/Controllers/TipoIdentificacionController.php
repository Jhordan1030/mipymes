<?php

namespace App\Http\Controllers;

use App\Models\TipoIdentificacion;
use Illuminate\Http\Request;

class TipoIdentificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoIdentificaciones = TipoIdentificacion::orderBy('id_tipo_identificacion', 'DESC')->paginate(5);
        return view('tipoidentificacion.index', compact('tipoIdentificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoidentificacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validamos los datos del formulario
        $request->validate([
            'codigo_tipo_identificacion' => 'required|max:5',
            'nombre_tipo_identificacion' => 'required|max:50'
        ]);

        // Creamos el registro
        TipoIdentificacion::create($request->all());

        // Redirigimos con un mensaje de éxito
        return redirect()->route('tipoidentificacion.index')
                         ->with('success', 'Tipo de Identificación creado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoIdentificacion = TipoIdentificacion::findOrFail($id);
        return view('tipoidentificacion.edit', compact('tipoIdentificacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validamos los datos del formulario
        $request->validate([
            'codigo_tipo_identificacion' => 'required|max:5',
            'nombre_tipo_identificacion' => 'required|max:50'
        ]);

        // Buscamos el registro y lo actualizamos
        $tipoIdentificacion = TipoIdentificacion::findOrFail($id);
        $tipoIdentificacion->update($request->all());

        // Redirigimos con un mensaje de éxito
        return redirect()->route('tipoidentificacion.index')
                         ->with('success', 'Tipo de Identificación actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscamos el registro y lo eliminamos
        $tipoIdentificacion = TipoIdentificacion::findOrFail($id);
        $tipoIdentificacion->delete();

        // Redirigimos con un mensaje de éxito
        return redirect()->route('tipoidentificacion.index')
                         ->with('success', 'Tipo de Identificación eliminado exitosamente');
    }
}

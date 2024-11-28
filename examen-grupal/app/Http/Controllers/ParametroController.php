<?php

namespace App\Http\Controllers;

use App\Models\Parametro;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parametros = Parametro::orderBy('id_parametro', 'DESC')->paginate(3); // Paginación de 3 registros por página
        return view('parametro.index', compact('parametros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'codigo_parametro' => 'required|string|max:10',
            'nombre_parametro' => 'required|string|max:100',
            'valor_parametro' => 'required|numeric',
            'descripcion_parametro' => 'nullable|string|max:255',
        ]);

        // Crear el parámetro
        Parametro::create($request->all());

        return redirect()->route('parametro.index')->with('success', 'Parámetro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parametro = Parametro::findOrFail($id); // Obtener el parámetro por id
        return view('parametro.show', compact('parametro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parametro = Parametro::findOrFail($id); // Obtener el parámetro por id
        return view('parametro.edit', compact('parametro'));
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
        // Validación de los datos
        $request->validate([
            'codigo_parametro' => 'required|string|max:10',
            'nombre_parametro' => 'required|string|max:100',
            'valor_parametro' => 'required|numeric',
            'descripcion_parametro' => 'nullable|string|max:255',
        ]);

        // Buscar el parámetro y actualizar sus valores
        $parametro = Parametro::findOrFail($id);
        $parametro->update($request->all());

        return redirect()->route('parametro.index')->with('success', 'Parámetro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar el parámetro
        Parametro::findOrFail($id)->delete();

        return redirect()->route('parametro.index')->with('success', 'Parámetro eliminado satisfactoriamente');
    }
}

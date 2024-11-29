<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEmpaque;

class TipoEmpaqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposEmpaque = TipoEmpaque::orderBy('id_tipo__empaque', 'DESC')->paginate(5);
        return view('tipo_empaque.index', compact('tiposEmpaque'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_empaque.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion_tipo__empaque' => 'required|max:100',
        ]);

        TipoEmpaque::create($request->all());
        return redirect()->route('tipo_empaque.index')->with('success', 'Tipo de Empaque creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoEmpaque = TipoEmpaque::find($id);
        return view('tipo_empaque.show', compact('tipoEmpaque'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoEmpaque = TipoEmpaque::find($id);
        return view('tipo_empaque.edit', compact('tipoEmpaque'));
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
        $request->validate([
            'descripcion_tipo__empaque' => 'required|max:100',
        ]);

        $tipoEmpaque = TipoEmpaque::find($id);
        $tipoEmpaque->update($request->all());

        return redirect()->route('tipo_empaque.index')->with('success', 'Tipo de Empaque actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TipoEmpaque::find($id)->delete();
        return redirect()->route('tipo_empaque.index')->with('success', 'Tipo de Empaque eliminado exitosamente');
    }
}
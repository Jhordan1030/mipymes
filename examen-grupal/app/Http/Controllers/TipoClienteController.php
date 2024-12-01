<?php

namespace App\Http\Controllers;

use App\Models\TipoCliente;
use Illuminate\Http\Request;

class TipoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoClientes = TipoCliente::orderBy('id_tipo_Cliente', 'DESC')->paginate(5);
        return view('tipocliente.index', compact('tipoClientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipocliente.create');
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
            'codigo_tipo_Cliente' => 'required',
            'descripcion_tipo_Cliente' => 'required',
        ]);

        TipoCliente::create($request->all());

        return redirect()->route('tipocliente.index')->with('success', 'Registro creado satisfactoriamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoCliente = TipoCliente::find($id);
        return view('tipocliente.edit', compact('tipoCliente'));
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
            'codigo_tipo_Cliente' => 'required',
            'descripcion_tipo_Cliente' => 'required',
        ]);

        $tipoCliente = TipoCliente::find($id);
        $tipoCliente->update($request->all());

        return redirect()->route('tipocliente.index')->with('success', 'Registro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TipoCliente::find($id)->delete();
        return redirect()->route('tipocliente.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}

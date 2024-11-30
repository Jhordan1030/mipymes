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
        //
        $cargos=Cargo::orderBy('id','DESC')->paginate(3);
        return view('cargo.index',compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cargo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([ 'codigo_cargo'=>'required', 'nombre_cargo'=>'required',]);
        Cargo::create($request->all());
        return redirect()->route('cargo.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cargos=Cargo::find($id);
        return  view('cargo.show',compact('cargos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $cargo=cargo::find($id);
        return view('cargo.edit',compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate(['codigo_cargo' => 'required', 'nombre_cargo'=>'required',]);

        $cargo = Cargo::find($id);

        $cargo->update($request->all());

        return redirect()->route('cargo.index')->with('success', 'Registro actualizado satisfactoriamente');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Cargo::find($id)->delete();
        return redirect()->route('cargo.index')->with('success','Registro eliminado satisfactoriamente');
    }
}

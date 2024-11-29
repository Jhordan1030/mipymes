<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $provincias=Provincia::orderBy('id','DESC')->paginate(3);
        return view('provincia.index',compact('provincias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('provincia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([ 'nombre'=>'required']);
        Provincia::create($request->all());
        return redirect()->route('provincia.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $provincias=Provincia::find($id);
        return  view('provincia.show',compact('provincias'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $provincia=provincia::find($id);
        return view('provincia.edit',compact('provincia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate(['nombre' => 'required']);

        $provincia = Provincia::find($id);

        $provincia->update($request->all());

        return redirect()->route('provincia.index')->with('success', 'Registro actualizado satisfactoriamente');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Provincia::find($id)->delete();
        return redirect()->route('provincia.index')->with('success','Registro eliminado satisfactoriamente');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canton;
use App\Models\Provincia;

class CantonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cantones = Canton::orderBy('id', 'DESC')->paginate(3); 
        //$cantones = Canton::with('provincia')->orderBy('id', 'DESC')->paginate(3);
        return view('canton.index', compact('cantones')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $provincias = Provincia::all();
        return view('canton.create', compact('provincias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([ 'nombre' => 'required', 
            'provincia_id' => 'required|exists:provincias,id', 
        ]);

        Canton::create($request->all());

        return redirect()->route('canton.index') ->with('success', 'Canton creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        //$canton = Canton::findOrFail($id);
        $canton = Canton::with('provincia')->findOrFail($id);
        return view('canton.show', compact('canton'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $canton = Canton::findOrFail($id);
        $provincias = Provincia::all();
        return view('canton.edit', compact('canton', 'provincias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([ 'nombre' => 'required', ]);

        $canton = Canton::findOrFail($id); 
        $canton->update($request->all());

        return redirect()->route('canton.index') ->with('success', 'Canton actualizado satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $canton = Canton::findOrFail($id); 
        $canton->delete();
        return redirect()->route('canton.index') ->with('success', 'Canton eliminado satisfactoriamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Asegúrate de importar esto

class BodegaController extends Controller
{

    use AuthorizesRequests; 
    public function __construct()
{  
    $this->authorizeResource(Bodega::class, 'bodega'); // ✅ Debe coincidir con la ruta
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bodegas = Bodega::orderBy('nombrebodega', 'DESC')->paginate(5);
        return view('bodega.index', compact('bodegas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bodega.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idbodega' => 'required',
            'nombrebodega' => 'required|max:10',
        ]);

        Bodega::create($request->all());
        return redirect()->route('bodega.index')->with('success', 'Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idbodega)
    {
        $bodega = Bodega::findOrFail($idbodega);
        return view('bodega.show', compact('bodega'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $idbodega)
    {
        $bodega = Bodega::findOrFail($idbodega);
        return view('bodega.edit', compact('bodega'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idbodega)
    {
        $request->validate([
            'idbodega' => 'required',
            'nombrebodega' => 'required|max:10',
            
        ]);

        Bodega::findOrFail($idbodega)->update($request->all());
        return redirect()->route('bodega.index')->with('success', 'Registro actualizado satisfactoriamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idbodega)
    {
        Bodega::findOrFail($idbodega)->delete();
        return redirect()->route('bodega.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}

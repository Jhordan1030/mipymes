<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Models\Producto;
use App\Models\DetalleUbicacion;
use Illuminate\Http\Request;

class DetalleUbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalleUbicaciones = DetalleUbicacion::with(['ubicacion', 'producto'])->paginate(10);
        return view('detalle_ubicacion.index', compact('detalleUbicaciones'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ubicaciones = Ubicacion::all(); // Obtén todas las ubicaciones
        $productos = Producto::all(); // Obtén todos los productos

        return view('detalle_ubicacion.create', compact('ubicaciones', 'productos'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idubicacion' => 'required|exists:ubicacion,idubicacion',
            'idproducto' => 'required|exists:producto,idproducto',
            'especificacionesdetalleubicacion' => 'required|string|max:254',
            'fechaingresodetalleproducto' => 'required|date'
        ]);
        

        DetalleUbicacion::create($request->all());

        return redirect()->route('detalle_ubicacion.index')->with('success', 'Detalle de ubicación creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detalleUbicacion = DetalleUbicacion::findOrFail($id);
        $ubicaciones = Ubicacion::all();
        $productos = Producto::all();

        return view('detalle_ubicacion.edit', compact('detalleUbicacion', 'ubicaciones', 'productos'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'idubicacion' => 'required|exists:ubicacion,idubicacion',
            'idproducto' => 'required|exists:producto,idproducto',
            'especificacionesdetalleubicacion' => 'required|string|max:254',
            'fechaingresodetalleproducto' => 'required|date'
        ]);
        

        $detalleUbicacion = DetalleUbicacion::findOrFail($id);
        $detalleUbicacion->update($request->all());

        return redirect()->route('detalle_ubicacion.index')->with('success', 'Detalle de ubicación actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DetalleUbicacion::findOrFail($id)->delete();
        return redirect()->route('detalle_ubicacion.index')->with('success', 'Detalle de ubicación eliminado correctamente');
    }
}

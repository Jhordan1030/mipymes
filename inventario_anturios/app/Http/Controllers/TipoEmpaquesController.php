<?php

namespace App\Http\Controllers;

use App\Models\TipoEmpaque;
use Illuminate\Http\Request;

class TipoEmpaquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipoEmpaque::query();

        // Filtra por el campo de búsqueda, si se proporciona
        if ($request->filled('search')) {
            $query->where('nombretipoempaque', 'like', '%' . $request->search . '%');
        }

        // Ordena y pagina los resultados
        $tipoEmpaques = $query->orderBy('nombretipoempaque', 'DESC')->paginate(5);

        // Retorna la vista con los datos
        return view('tipoempaque.index', compact('tipoEmpaques'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipoempaque.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombretipoempaque' => 'required',
            'codigotipoempaque' => 'required'
        ]);

        TipoEmpaque::create($request->all());
        return redirect()->route('tipoempaque.index')->with('success', 'Tipo de empaque creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $codigotipoempaque)
    {
        $codigotipoempaque = TipoEmpaque::find($codigotipoempaque);
        return view('tipoempaque.show', compact('tipoEmpaque'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**public function edit(string $codigotipoempaque)
    {
        $tipoempaque = TipoEmpaque::findOrFail($codigotipoempaque);
        return view('tipoempaque.edit', compact('tipoempaque'));
    }
*/
public function edit($codigotipoempaque)
{
    $tipoEmpaque = TipoEmpaque::where('codigotipoempaque', $codigotipoempaque)->firstOrFail();

    return view('tipoempaque.edit', compact('tipoEmpaque'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $codigotipoempaque)
    {
        $request->validate([
            'nombretipoempaque' => 'required',
            'codigotipoempaque' => 'required'
        ]);

        $tipoEmpaque = TipoEmpaque::find($codigotipoempaque);
        $tipoEmpaque->update($request->all());
        return redirect()->route('tipoempaque.index')->with('success', 'Tipo de empaque actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $codigotipoempaque)
    {
        $tipoEmpaque = TipoEmpaque::find($codigotipoempaque);
        $tipoEmpaque->delete();
        return redirect()->route('tipoempaque.index')->with('success', 'Tipo de empaque eliminado con éxito.');
    }
}

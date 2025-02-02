<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Asegúrate de importar esto
class CargoController extends Controller
{
    //Aqu[i es donde estoy dando permisos
    
    use AuthorizesRequests; 
    public function __construct()
{
    
    $this->authorizeResource(Cargo::class, 'cargo'); // ✅ Debe coincidir con la ruta
}
    public function index()
    {
        $cargos = Cargo::paginate(10);
        return view('cargo.index', compact('cargos'));
    }

    public function create()
    {
        return view('cargo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigocargo' => 'required|string|max:50|unique:cargos,codigocargo',
            'nombrecargo' => 'required|string|max:100|unique:cargos,nombrecargo|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/',
        ], [
            'codigocargo.unique' => 'El código del cargo ya existe.',
            'nombrecargo.unique' => 'El nombre del cargo ya existe.',
            'nombrecargo.regex' => 'El nombre del cargo solo puede contener letras y espacios.',
        ]);

        Cargo::create($request->all());

        return redirect()->route('cargo.index')->with('success', 'Cargo creado con éxito.');
    }

    public function edit($codigocargo)
    {
        $cargo = Cargo::where('codigocargo', $codigocargo)->firstOrFail();
        return view('cargo.edit', compact('cargo'));
    }

    public function update(Request $request, $codigocargo)
    {
        $cargo = Cargo::where('codigocargo', $codigocargo)->firstOrFail();

        $request->validate([
            'codigocargo' => "required|string|max:50|unique:cargos,codigocargo,$codigocargo,codigocargo",
            'nombrecargo' => "required|string|max:100|unique:cargos,nombrecargo,$codigocargo,codigocargo|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/",
        ], [
            'codigocargo.unique' => 'El código del cargo ya existe.',
            'nombrecargo.unique' => 'El nombre del cargo ya existe.',
            'nombrecargo.regex' => 'El nombre del cargo solo puede contener letras y espacios.',
        ]);

        $cargo->update($request->all());

        return redirect()->route('cargo.index')->with('success', 'Cargo actualizado con éxito.');
    }

    public function destroy($codigocargo)
    {
        $cargo = Cargo::where('codigocargo', $codigocargo)->firstOrFail();
        $cargo->delete();

        return redirect()->route('cargo.index')->with('success', 'Cargo eliminado con éxito.');
    }
}

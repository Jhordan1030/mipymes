<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
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
        // Solo validamos que los campos sean obligatorios (sin restricciones adicionales)
        $request->validate([
            'codigocargo' => 'required', // Solo obligatorio
            'nombrecargo' => 'required', // Solo obligatorio
        ]);

        try {
            // Llamamos al trigger de la base de datos
            Cargo::create($request->all());

            return redirect()->route('cargo.index')->with('success', 'Cargo creado con éxito.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Captura el error y extrae el mensaje del trigger
            $errorMessage = $e->getMessage();

            // Verificamos si el error es del trigger, y extraemos el mensaje adecuado
            if (preg_match("/ERROR:  (.*?)\\n/", $errorMessage, $matches)) {
                // Extraemos el mensaje de error del trigger
                $errorText = trim($matches[1]);
            } else {
                // Si no es el error esperado, mostramos un error genérico
                $errorText = 'Error al crear el cargo.';
            }

            // Retorna con el error capturado
            return redirect()->back()->withInput()->with('error', $errorText);
        }
    }

    public function update(Request $request, $codigocargo)
    {
        $cargo = Cargo::where('codigocargo', $codigocargo)->firstOrFail();

        try {
            // Llamar al trigger de la base de datos
            $cargo->update($request->all());

            return redirect()->route('cargo.index')->with('success', 'Cargo actualizado con éxito.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Captura el error y extrae el mensaje del trigger
            $errorMessage = $e->getMessage();

            if (preg_match("/ERROR:  (.*?)\\n/", $errorMessage, $matches)) {
                // Extraemos el mensaje de error del trigger
                $errorText = trim($matches[1]);
            } else {
                // Si no es el error esperado, mostramos un error genérico
                $errorText = 'Error al actualizar el cargo.';
            }

            // Retorna con el error capturado
            return redirect()->back()->withInput()->with('error', $errorText);
        }
    }

    public function edit($codigocargo)
    {
        $cargo = Cargo::where('codigocargo', $codigocargo)->firstOrFail();
        return view('cargo.edit', compact('cargo'));
    }

    public function destroy($codigocargo)
    {
        $cargo = Cargo::where('codigocargo', $codigocargo)->firstOrFail();
        $cargo->delete();

        return redirect()->route('cargo.index')->with('success', 'Cargo eliminado con éxito.');
    }
}

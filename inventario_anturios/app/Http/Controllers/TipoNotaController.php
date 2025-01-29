<?php

namespace App\Http\Controllers;

use App\Models\TipoNota;
use App\Models\DetalleTipoNota;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Bodega;
use App\Models\TipoEmpaque;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TipoNotaController extends Controller
{
    /**
     * Mostrar todas las notas con sus productos agrupados.
     */
    public function index()
    {
        $tipoNotas = TipoNota::with([
            'detalles.producto',
            'detalles.tipoEmpaque', // Se agrega la relación con tipo de empaque
            'responsableEmpleado',
            'bodega'
        ])->orderBy('idtiponota', 'DESC')->paginate(5);

        return view('tipoNota.index', compact('tipoNotas'));
    }


    /**
     * Mostrar formulario para crear una nueva nota.
     */
    public function create()
    {
        $tipoempaques = TipoEmpaque::all();
        $empleados = Empleado::all();
        $productos = Producto::all();
        $bodegas = Bodega::all();

        return view('tipoNota.create', compact('empleados', 'productos', 'bodegas', 'tipoempaques'));
    }

    /**
     * Guardar una nueva nota con múltiples productos.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tiponota' => 'required|in:ENVIO,DEVOLUCION',
                'idempleado' => 'required|integer|exists:empleados,idempleado',
                'codigoproducto' => 'required|array|min:1',
                'codigoproducto.*' => 'required|string|exists:productos,codigo',
                'cantidad' => 'required|array|min:1',
                'cantidad.*' => 'required|integer|min:1',
                'codigotipoempaque' => 'nullable|array|min:1',
                'codigotipoempaque.*' => 'nullable|string|exists:tipoempaques,codigotipoempaque',
                'idbodega' => 'required|string|exists:bodegas,idbodega',
            ]);

            $codigoGenerado = 'TN-' . (TipoNota::count() + 1);

            $nota = TipoNota::create([
                'codigo' => $codigoGenerado,
                'tiponota' => $request->tiponota,
                'idempleado' => $request->idempleado,
                'idbodega' => $request->idbodega,
                'fechanota' => now(),
            ]);

            foreach ($request->codigoproducto as $index => $codigoProducto) {
                DetalleTipoNota::create([
                    'tipo_nota_id' => $nota->idtiponota,
                    'codigoproducto' => $codigoProducto,
                    'cantidad' => $request->cantidad[$index],
                    'codigotipoempaque' => $request->codigotipoempaque[$index] ?? null,
                ]);
            }

            return redirect()->route('tipoNota.index')->with('success', 'Nota creada correctamente.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Error en BD: ' . $e->getMessage()])->withInput();
        }
    }




    /**
     * Mostrar formulario de edición de una nota.
     */
    public function edit($id)
    {
        $tipoNota = TipoNota::with('detalles')->findOrFail($id);
        $tipoempaques = TipoEmpaque::all();
        $empleados = Empleado::all();
        $productos = Producto::all();
        $bodegas = Bodega::all();

        return view('tipoNota.edit', compact('tipoNota', 'empleados', 'productos', 'bodegas', 'tipoempaques'));
    }

    /**
     * Actualizar una nota con sus productos.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'tiponota' => 'required|in:ENVIO,DEVOLUCION',
                'idempleado' => 'required|integer|exists:empleados,idempleado',
                'codigoproducto' => 'required|array|min:1',
                'codigoproducto.*' => 'required|string|exists:productos,codigo',
                'cantidad' => 'required|array|min:1',
                'cantidad.*' => 'required|integer|min:1',
                'idbodega' => 'required|string|exists:bodegas,idbodega',
            ]);

            $nota = TipoNota::findOrFail($id);
            $nota->update([
                'tiponota' => $request->tiponota,
                'idempleado' => $request->idempleado,
                'idbodega' => $request->idbodega,
                'fechanota' => now(),
            ]);

            // Eliminar productos anteriores y agregar los nuevos
            $nota->detalles()->delete();
            foreach ($request->codigoproducto as $index => $codigoProducto) {
                DetalleTipoNota::create([
                    'tipo_nota_id' => $nota->idtiponota,
                    'codigoproducto' => $codigoProducto,
                    'cantidad' => $request->cantidad[$index],
                    'codigotipoempaque' => $request->codigotipoempaque[$index] ?? null,
                ]);
            }

            return redirect()->route('tipoNota.index')->with('success', 'Nota actualizada correctamente.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Error en BD: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Eliminar una nota y sus productos relacionados.
     */
    public function destroy($id)
    {
        try {
            $nota = TipoNota::findOrFail($id);
            $nota->delete();

            return redirect()->route('tipoNota.index')->with('success', 'Nota eliminada correctamente.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Error al eliminar: ' . $e->getMessage()]);
        }
    }
}

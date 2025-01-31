<?php

namespace App\Http\Controllers;

use App\Models\TipoNota;
use App\Models\Empleado;
use App\Models\Bodega;
use App\Models\Producto;
use App\Models\DetalleTipoNota;
use App\Models\TipoEmpaque;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDF;

class TipoNotaController extends Controller
{
    /**
     * Muestra la lista de tipos de notas.
     */
    public function index()
    {
        $tipoNotas = TipoNota::with(['responsableEmpleado', 'bodega', 'detalles.producto', 'transaccionProducto'])
            ->paginate(1000); // Se usa paginación para mejorar rendimiento

        return view('tipoNota.index', compact('tipoNotas'));
    }

    /**
     * Muestra el formulario para crear una nueva nota.
     */
    public function create()
    {
        $empleados = Empleado::all();
        $bodegas = Bodega::all();
        $productos = Producto::all();
        $tipoempaques = TipoEmpaque::all();

        return view('tipoNota.create', compact('empleados', 'bodegas', 'productos', 'tipoempaques'));
    }

    /**
     * Guarda una nueva nota en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tiponota' => 'required|string|max:255',
            'idempleado' => 'required|exists:empleados,idempleado',
            'idbodega' => 'required|exists:bodegas,idbodega',
            'codigoproducto' => 'required|array',
            'cantidad' => 'required|array',
        ]);

        try {
            DB::beginTransaction(); // Inicia la transacción para garantizar la consistencia

            // ✅ Generar automáticamente el código en formato TN-1, TN-2, TN-3...
            $ultimoCodigo = TipoNota::latest('codigo')->first();
            if ($ultimoCodigo) {
                $numero = intval(str_replace('TN-', '', $ultimoCodigo->codigo)) + 1;
            } else {
                $numero = 1;
            }
            $codigoGenerado = 'TN-' . $numero;

            // ✅ Crear la nueva nota con la fecha actual del sistema
            $nota = TipoNota::create([
                'codigo' => $codigoGenerado,
                'tiponota' => $request->tiponota,
                'idempleado' => $request->idempleado,
                'idbodega' => $request->idbodega,
                'fechanota' => now(), // Fecha actual del sistema
            ]);

            // ✅ Guardar los productos en la tabla de detalles
            foreach ($request->codigoproducto as $index => $productoId) {
                DetalleTipoNota::create([
                    'tipo_nota_id' => $nota->codigo,
                    'codigoproducto' => $productoId,
                    'cantidad' => $request->cantidad[$index],
                    'codigotipoempaque' => $request->codigotipoempaque[$index] ?? null,
                ]);
            }

            DB::commit(); // Confirma la transacción
            return redirect()->route('tipoNota.index')->with('success', 'Nota creada exitosamente.');
        } catch (QueryException $e) {
            DB::rollBack(); // Revertir transacción en caso de error
            return redirect()->back()->with('error', 'Error al crear la nota.');
        }
    }

    /**
     * Muestra una nota específica.
     */
    public function show($codigo)
    {
        $tipoNota = TipoNota::with(['responsableEmpleado', 'bodega', 'detalles.producto'])->findOrFail($codigo);
        return view('tipoNota.show', compact('tipoNota'));
    }

    /**
     * Muestra el formulario para editar una nota.
     */
    public function edit($codigo)
    {
        $tipoNota = TipoNota::with('detalles')->findOrFail($codigo);
        $empleados = Empleado::all();
        $bodegas = Bodega::all();
        $productos = Producto::all();
        $tipoempaques = TipoEmpaque::all();

        return view('tipoNota.edit', compact('tipoNota', 'empleados', 'bodegas', 'productos', 'tipoempaques'));
    }

    /**
     * Actualiza una nota en la base de datos.
     */
    public function update(Request $request, $codigo)
    {
        $request->validate([
            'tiponota' => 'required|string|max:255',
            'idempleado' => 'required|exists:empleados,idempleado',
            'idbodega' => 'required|exists:bodegas,idbodega',
            'codigoproducto' => 'required|array',
            'cantidad' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            // Buscar la nota
            $nota = TipoNota::findOrFail($codigo);
            $nota->update([
                'tiponota' => $request->tiponota,
                'idempleado' => $request->idempleado,
                'idbodega' => $request->idbodega,
            ]);

            // ✅ Eliminar detalles anteriores
            $nota->detalles()->delete();

            // ✅ Guardar nuevos detalles
            foreach ($request->codigoproducto as $index => $productoId) {
                DetalleTipoNota::create([
                    'tipo_nota_id' => $nota->codigo,
                    'codigoproducto' => $productoId,
                    'cantidad' => $request->cantidad[$index],
                    'codigotipoempaque' => $request->codigotipoempaque[$index] ?? null,
                ]);
            }

            DB::commit();
            return redirect()->route('tipoNota.index')->with('success', 'Nota actualizada correctamente.');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar la nota.');
        }
    }


    /**
     * Elimina una nota.
     */
    public function destroy($codigo)
    {
        try {
            DB::beginTransaction();
            $nota = TipoNota::findOrFail($codigo);
            $nota->detalles()->delete(); // Elimina los detalles antes de eliminar la nota
            $nota->delete();
            DB::commit();

            return redirect()->route('tipoNota.index')->with('success', 'Nota eliminada correctamente.');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al eliminar la nota.');
        }
    }

    /**
     * Genera un PDF con la información de una nota.
     */
    public function generarPDF($codigo)
    {
        $nota = TipoNota::with(['responsableEmpleado', 'bodega', 'detalles.producto', 'detalles.tipoEmpaque', 'transaccionProducto'])
            ->findOrFail($codigo);

        $pdf = PDF::loadView('tipoNota.pdf', compact('nota'));

        return $pdf->download("Nota_{$nota->codigo}.pdf");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TipoNota;
use App\Models\Empleado;
use App\Models\Bodega;
use App\Models\Producto;
use App\Models\DetalleTipoNota;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDF;

class TipoNotaController extends Controller
{
    /**
     * Muestra la lista de notas.
     */
    public function index()
    {
        $tipoNotas = TipoNota::with(['responsableEmpleado', 'bodega', 'detalles.producto', 'transaccion'])
            ->paginate(10);

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

        return view('tipoNota.create', compact('empleados', 'bodegas', 'productos'));
    }

    /**
     * Guarda una nueva nota en la base de datos.
     */
    public function store(Request $request)
    {
        // 🔹 Verificar los datos recibidos (descomentar para pruebas)
        // dd($request->all());

        // 🔹 Validar los datos
        $request->validate([
            'tiponota' => 'required|string|max:255',
            'nro_identificacion' => 'required|exists:empleados,nro_identificacion',
            'idbodega' => 'required|string|exists:bodegas,idbodega',
            'codigoproducto' => 'required|array|min:1',
            'cantidad' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();

            // 🔹 Generar el código único (TN-1, TN-2, ...)
            $ultimoCodigo = TipoNota::latest('codigo')->first();
            $numero = $ultimoCodigo ? intval(str_replace('TN-', '', $ultimoCodigo->codigo)) + 1 : 1;
            $codigoGenerado = 'TN-' . $numero;

            // 🔹 Crear la nueva nota
            $nota = TipoNota::create([
                'codigo' => $codigoGenerado,
                'tiponota' => $request->tiponota,
                'nro_identificacion' => $request->nro_identificacion,
                'idbodega' => $request->idbodega,
                'fechanota' => now(),
            ]);

            // 🔹 Guardar los detalles sin modificar el stock
            foreach ($request->codigoproducto as $index => $productoId) {
                DetalleTipoNota::create([
                    'tipo_nota_id' => $nota->codigo,
                    'codigoproducto' => $productoId,
                    'cantidad' => $request->cantidad[$index],
                ]);
            }

            DB::commit();
            return redirect()->route('tipoNota.index')->with('success', 'Nota creada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear la nota: ' . $e->getMessage());
        }
    }

    /**
     * Muestra una nota específica.
     */
    public function show($codigo)
    {
        $tipoNota = TipoNota::with(['responsableEmpleado', 'bodega', 'detalles.producto'])
            ->where('codigo', $codigo)
            ->firstOrFail();

        return view('tipoNota.show', compact('tipoNota'));
    }

    /**
     * Muestra el formulario para editar una nota.
     */
    public function edit($codigo)
    {
        $tipoNota = TipoNota::with('detalles')->where('codigo', $codigo)->firstOrFail();
        $empleados = Empleado::all();
        $bodegas = Bodega::all();
        $productos = Producto::all();

        return view('tipoNota.edit', compact('tipoNota', 'empleados', 'bodegas', 'productos'));
    }

    /**
     * Actualiza una nota en la base de datos.
     */
    public function update(Request $request, $codigo)
    {
        // 🔹 Validar los datos
        $request->validate([
            'tiponota' => 'required|string|max:255',
            'nro_identificacion' => 'required|exists:empleados,nro_identificacion',
            'idbodega' => 'required|string|exists:bodegas,idbodega',
            'codigoproducto' => 'required|array|min:1',
            'cantidad' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();

            $nota = TipoNota::where('codigo', $codigo)->firstOrFail();
            $nota->update([
                'tiponota' => $request->tiponota,
                'nro_identificacion' => $request->nro_identificacion,
                'idbodega' => $request->idbodega,
            ]);

            // 🔹 Eliminar detalles anteriores
            $nota->detalles()->delete();

            // 🔹 Guardar nuevos detalles
            foreach ($request->codigoproducto as $index => $productoId) {
                DetalleTipoNota::create([
                    'tipo_nota_id' => $nota->codigo,
                    'codigoproducto' => $productoId,
                    'cantidad' => $request->cantidad[$index],
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
            $nota = TipoNota::where('codigo', $codigo)->firstOrFail();
            $nota->detalles()->delete();
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
        $nota = TipoNota::with(['responsableEmpleado', 'bodega', 'detalles.producto'])
            ->where('codigo', $codigo)
            ->firstOrFail();

        $pdf = PDF::loadView('tipoNota.pdf', compact('nota'));

        return $pdf->download("Nota_{$nota->codigo}.pdf");
    }
}

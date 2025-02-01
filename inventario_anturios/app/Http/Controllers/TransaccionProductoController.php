<?php

namespace App\Http\Controllers;

use App\Models\TransaccionProducto;
use App\Models\TipoNota;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class TransaccionProductoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $estado = $request->input('estado');

        $query = TransaccionProducto::with('tipoNota.detalles.producto');

        if ($estado) {
            $query->where('estado', $estado);
        }

        if ($search) {
            $query->whereHas('tipoNota', function ($q) use ($search) {
                $q->where('codigo', 'LIKE', "%$search%");
            });
        }

        $pendientes = TransaccionProducto::where('estado', 'PENDIENTE')->count();
        $finalizadas = TransaccionProducto::where('estado', 'FINALIZADA')->count();

        $transacciones = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('transaccionProducto.index', compact('transacciones', 'pendientes', 'finalizadas', 'search', 'estado'));
    }
    public function confirmar($codigo)
    {
        try {
            DB::beginTransaction();

            // Buscar la nota
            $nota = TipoNota::with('detalles')->where('codigo', $codigo)->firstOrFail();

            // Crear la transacción
            $transaccion = TransaccionProducto::create([
                'tipo_nota_id' => $nota->codigo,
                'estado' => 'PENDIENTE',
            ]);

            DB::commit();
            return redirect()->route('tipoNota.index')->with('success', 'Nota confirmada y transacción creada.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al confirmar la nota.');
        }
    }

    public function finalizar($id)
    {
        try {
            DB::beginTransaction();

            $transaccion = TransaccionProducto::with('tipoNota.detalles.producto')->findOrFail($id);

            // Verificar el tipo de nota (ENVIO o DEVOLUCION)
            $tipoNota = $transaccion->tipoNota;

            foreach ($tipoNota->detalles as $detalle) {
                $producto = $detalle->producto;
                if ($producto) {
                    if ($tipoNota->tiponota === 'ENVIO') {
                        // Restar del stock en caso de ENVIO
                        $producto->cantidad -= $detalle->cantidad;
                    } elseif ($tipoNota->tiponota === 'DEVOLUCION') {
                        // Sumar al stock en caso de DEVOLUCION
                        $producto->cantidad += $detalle->cantidad;
                    }
                    $producto->save(); // Guardar la actualización del stock
                }
            }

            // Marcar la transacción como FINALIZADA
            $transaccion->update(['estado' => 'FINALIZADA']);

            DB::commit();

            return redirect()->route('transaccionProducto.index')->with('success', 'Transacción finalizada correctamente y stock actualizado.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al finalizar la transacción: ' . $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TransaccionProducto;
use App\Models\TipoNota;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TransaccionProductoController extends Controller
{
    /**
     * Muestra la lista de transacciones.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $estado = $request->input('estado');

        $query = TransaccionProducto::with('tipoNota.detalles.producto', 'tipoNota.detalles.tipoEmpaque');

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

        $transacciones = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('transaccionProducto.index', compact('transacciones', 'pendientes', 'finalizadas', 'search', 'estado'));
    }

    /**
     * Confirma una nota y la convierte en transacción.
     */
    public function confirmar($codigo)
    {
        try {
            $tipoNota = TipoNota::where('codigo', $codigo)->firstOrFail();

            if (TransaccionProducto::where('tipo_nota_id', $tipoNota->codigo)->exists()) {
                return redirect()->route('tipoNota.index')->withErrors(['error' => 'La nota ya ha sido confirmada.']);
            }

            TransaccionProducto::create([
                'tipo_nota_id' => $tipoNota->codigo,
                'estado' => 'PENDIENTE',
            ]);

            return redirect()->route('tipoNota.index')->with('success', 'Nota confirmada y enviada a transacciones.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Error al confirmar la nota.']);
        }
    }

    /**
     * Finaliza una transacción.
     */
    public function finalizar(Request $request, $id)
    {
        try {
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

            return redirect()->route('transaccionProducto.index')->with('success', 'Transacción finalizada correctamente y stock actualizado.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al finalizar la transacción: ' . $e->getMessage()]);
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\TransaccionProducto;
use App\Models\TipoNota;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TransaccionProductoController extends Controller
{
    /**
     * Muestra todas las transacciones con su estado y productos asociados.
     */
    public function index()
    {
        $pendientes = TransaccionProducto::where('estado', 'PENDIENTE')->count();
        $finalizadas = TransaccionProducto::where('estado', 'FINALIZADO')->count();

        $transacciones = TransaccionProducto::with([
            'tipoNota.detalles.producto',
            'tipoNota.detalles.tipoEmpaque'
        ])->paginate(5);

        return view('transaccionProducto.index', compact('transacciones', 'pendientes', 'finalizadas'));
    }

    /**
     * Confirma la transacción de una nota.
     */
    public function confirmar($codigo)
    {
        try {
            $tipoNota = TipoNota::where('codigo', $codigo)->firstOrFail();

            $transaccion = TransaccionProducto::create([
                'tipo_nota_id' => $tipoNota->codigo,
                'estado' => 'PENDIENTE', // Estado inicial
            ]);

            return redirect()->route('transaccionProducto.index')->with('success', 'Transacción confirmada.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Error al confirmar transacción: ' . $e->getMessage()]);
        }
    }

    /**
     * Finaliza una transacción pendiente.
     */
    public function finalizar($id)
    {
        try {
            $transaccion = TransaccionProducto::findOrFail($id);
            $transaccion->update(['estado' => 'FINALIZADO']);

            return redirect()->route('transaccionProducto.index')->with('success', 'Transacción finalizada correctamente.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Error al finalizar transacción: ' . $e->getMessage()]);
        }
    }
}

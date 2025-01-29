<?php

namespace App\Http\Controllers;

use App\Models\TransaccionProducto;
use App\Models\TipoNota;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TransaccionProductoController extends Controller
{
    /**
     * Mostrar todas las transacciones con sus productos.
     */
    public function index(Request $request)
        {
            // Obtener filtros de búsqueda y estado
            $search = $request->input('search');
            $estado = $request->input('estado');

            // Filtrar por estado si se selecciona uno
            $query = TransaccionProducto::with('tipoNota.detalles.producto', 'tipoNota.detalles.tipoEmpaque');

            if ($estado) {
                $query->where('estado', $estado);
            }

            // Filtrar por código de nota si se busca uno
            if ($search) {
                $query->whereHas('tipoNota', function ($q) use ($search) {
                    $q->where('codigo', 'LIKE', "%$search%");
                });
            }

            // Obtener el número de transacciones pendientes y finalizadas
            $pendientes = TransaccionProducto::where('estado', 'PENDIENTE')->count();
            $finalizadas = TransaccionProducto::where('estado', 'FINALIZADA')->count();

            // Paginar resultados
            $transacciones = $query->orderBy('created_at', 'desc')->paginate(5);

            return view('transaccionProducto.index', compact('transacciones', 'pendientes', 'finalizadas', 'search', 'estado'));
        }

    /**
     * Confirmar una nota y moverla a transacción de producto.
     */
    public function confirmar($codigo)
    {
        try {
            $tipoNota = TipoNota::where('codigo', $codigo)->firstOrFail();

            // Verificar si ya existe una transacción para esta nota
            if (TransaccionProducto::where('tipo_nota_id', $tipoNota->codigo)->exists()) {
                return redirect()->route('tipoNota.index')->withErrors(['error' => 'La nota ya ha sido confirmada.']);
            }

            // Crear la transacción
            TransaccionProducto::create([
                'tipo_nota_id' => $tipoNota->codigo,
                'estado' => 'PENDIENTE',
            ]);

            return redirect()->route('tipoNota.index')->with('success', 'Nota confirmada y enviada a transacciones.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Error al confirmar la nota: ' . $e->getMessage()]);
        }
    }

    /**
     * Finalizar una transacción.
     */
    public function finalizar($id)
    {
        try {
            $transaccion = TransaccionProducto::findOrFail($id);
            $transaccion->update(['estado' => 'FINALIZADA']);

            return redirect()->route('transaccionProducto.index')->with('success', 'Transacción finalizada correctamente.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Error al finalizar la transacción: ' . $e->getMessage()]);
        }
    }
}

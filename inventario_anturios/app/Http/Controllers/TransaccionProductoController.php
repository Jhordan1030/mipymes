<?php

namespace App\Http\Controllers;

use App\Models\TransaccionProducto;
use App\Models\TipoNota;
use App\Models\Producto;
use App\Models\DetalleTipoNota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaccionProductoController extends Controller
{
    /**
     * Lista todas las transacciones
     */
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

    /**
     * Confirma la nota, pero NO modifica el stock.
     */
    public function confirmar($codigo)
    {
        try {
            DB::beginTransaction();

            // Buscar la nota
            $nota = TipoNota::with('detalles')->where('codigo', $codigo)->firstOrFail();

            // Crear la transacción sin modificar el stock aún
            TransaccionProducto::create([
                'tipo_nota_id' => $nota->codigo,
                'estado' => 'PENDIENTE',
            ]);

            DB::commit();
            return redirect()->route('tipoNota.index')->with('success', 'Nota confirmada. Ahora debes finalizar la transacción.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al confirmar la nota: ' . $e->getMessage());
        }
    }

    /**
     * Finaliza la transacción y ACTUALIZA el stock
     */
    public function finalizar($id)
    {
        try {
            DB::beginTransaction();

            // 🔹 Buscar la transacción
            $transaccion = TransaccionProducto::findOrFail($id);
            $nota = $transaccion->tipoNota;

            // 🔹 Buscar los detalles asociados a la nota
            $detalles = DetalleTipoNota::where('tipo_nota_id', $nota->codigo)->get();

            foreach ($detalles as $detalle) {
                $producto = Producto::where('codigo', $detalle->codigoproducto)->firstOrFail();

                // 🔹 Modificar cantidad según el tipo de nota
                if ($nota->tiponota === 'ENVIO') {
                    if ($producto->cantidad < $detalle->cantidad) {
                        DB::rollBack();
                        return redirect()->back()->with('error', "Stock insuficiente para el producto: {$producto->nombre}.");
                    }
                    $producto->cantidad -= $detalle->cantidad;
                } elseif ($nota->tiponota === 'DEVOLUCION') {
                    $producto->cantidad += $detalle->cantidad;
                }

                $producto->save();
            }

            // 🔹 Marcar la transacción como finalizada
            $transaccion->estado = 'FINALIZADA';
            $transaccion->save();

            DB::commit();
            return redirect()->route('transaccionProducto.index')->with('success', 'Transacción finalizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al finalizar la transacción: ' . $e->getMessage());
        }
    }


}

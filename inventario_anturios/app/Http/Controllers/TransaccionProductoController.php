<?php

namespace App\Http\Controllers;

use App\Models\TransaccionProducto;
use App\Models\TipoNota;
use App\Models\Producto;
use App\Models\Bodega;
use App\Models\Empleado;
use App\Models\TipoEmpaque;
use Illuminate\Http\Request;

class TransaccionProductoController extends Controller
{
    public function index()
    {
        $transacciones = TransaccionProducto::with(['tipoNota', 'producto', 'bodega', 'responsable', 'tipoEmpaque'])
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('transaccionProducto.index', compact('transacciones'));
    }

    public function create()
    {
        $tipoNotas = TipoNota::all();
        $productos = Producto::all();
        $bodegas = Bodega::all();
        $empleados = Empleado::all();
        $tipoEmpaques = TipoEmpaque::all();
        return view('transaccionProducto.create', compact('tipoNotas', 'productos', 'bodegas', 'empleados', 'tipoEmpaques'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_tipo_nota' => 'required|exists:tipo_nota,codigo',
            'codigo_producto' => 'required|exists:productos,codigo',
            'tipo_empaque' => 'required|exists:tipoempaques,codigotipoempaque',
            'cantidad' => 'required|integer|min:1',
            'bodega_destino' => 'required|exists:bodegas,idbodega',
            'responsable' => 'required|exists:empleados,idempleado',
        ]);

        TransaccionProducto::create([
            'codigo_tipo_nota' => $request->codigo_tipo_nota,
            'codigo_producto' => $request->codigo_producto,
            'tipo_empaque' => $request->tipo_empaque,
            'cantidad' => $request->cantidad,
            'bodega_destino' => $request->bodega_destino,
            'responsable' => $request->responsable,
            'fecha_entrega' => now(),
        ]);

        return redirect()->route('transaccionProducto.index')->with('success', 'Transacción guardada correctamente.');
    }
}
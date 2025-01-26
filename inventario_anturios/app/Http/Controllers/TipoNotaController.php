<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;
use App\Models\TipoNota;
use App\Models\Empleado;
use App\Models\Producto;

class TipoNotaController extends Controller
{
    public function index()
    {
        $tipoNotas = TipoNota::with(['responsableEmpleado','producto','bodega'])->orderBy('idtiponota', 'DESC')->paginate(5);
        return view('tipoNota.index', compact('tipoNotas'));
    }

   


   
    public function create()
    {
        $tipoempaques = \App\Models\TipoEmpaque::all();
        $empleados = Empleado::all(); // Obtener todos los empleados
        $productos = Producto::all();
        $bodegas = Bodega::all();
        return view('tipoNota.create', compact('empleados','productos','bodegas','tipoempaques'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tiponota' => 'required|in:ENVIO,DEVOLUCION',
            'responsable' => 'required|max:20',
            'codigoproducto' => 'required|array|min:1',
            'codigoproducto.*' => 'required|string|exists:productos,codigo',
            'cantidad' => 'required|array|min:1',
            'cantidad.*' => 'required|integer|min:1',
            'codigotipoempaque' => 'required|array|min:1', // Validar que sea un array
            'codigotipoempaque.*' => 'required|string|exists:tipoempaques,codigotipoempaque', // Validar cada valor del array
            'idbodega' => 'required|string|exists:bodegas,idbodega',
            'fechanota' => 'required|date',
            
        ]);
    
        foreach ($request->codigoproducto as $index => $codigoProducto) {
            TipoNota::create([
                'tiponota' => $request->tiponota,
                'responsable' => $request->responsable,
                'codigoproducto' => $codigoProducto,
                'cantidad' => $request->cantidad[$index],
                'codigotipoempaque' => $request->codigotipoempaque[$index] ?? null, 
                'idbodega' => $request->idbodega,
                'fechanota' => $request->fechanota,
               
                
            ]);
            if ($request->tiponota === 'INGRESO') {
                $producto = Producto::where('codigo', $codigoProducto)->first();
                if ($producto) {
                    $producto->cantidad += $request->cantidad[$index]; // Sumar la cantidad ingresada
                    $producto->save();
                }
        }

    
        return redirect()->route('tipoNota.index')->with('success', 'Nota creada exitosamente.');
    }
}
    


    

    public function edit($id)
    {
        $tipoempaques = TipoNota::all();
        $tipoNota = TipoNota::with(['responsableEmpleado','bodega'])->findOrFail($id);
        $empleados = Empleado::all(); // Para el dropdown
        $productos = Producto::all();
        $bodegas = Bodega::all();
        return view('tipoNota.edit', compact('tipoNota', 'empleados','bodegas'));
    }


    


    public function update(Request $request, $id)
    {
        $request->validate([
            'tiponota' => 'required|max:10',
            'responsable' => 'required|max:20',
            'codigoproducto' => 'nullable|string|exists:productos,codigo',
            'cantidad' => 'nullable|integer|min:1',
            'codigotipoempaque' => 'nullable|string|exists:tipoempaques,codigotipoempaque',
            'idbodega' => 'required|integer|exists:bodegas,idbodega',
            'fechanota' => 'required|date',
           
        ]);

        $tipoNota = TipoNota::findOrFail($id);
        $tipoNota->update($request->all());
        return redirect()->route('tipoNota.index')->with('success', 'Registro actualizado satisfactoriamente.');
    }

    public function destroy($id)
    {
        $tipoNota = TipoNota::findOrFail($id);
        $tipoNota->delete();
        return redirect()->route('tipoNota.index')->with('success', 'Registro eliminado satisfactoriamente.');
    }

    
}

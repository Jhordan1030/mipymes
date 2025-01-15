<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\TipoIdentificacion;
use App\Models\Bodega;
use App\Models\Cargo;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('tipoIdentificacion', 'bodega', 'cargo')->paginate(10);
        return view('empleado.index', compact('empleados'));
    }

    public function create()
    {
        $tipoIdentificaciones = TipoIdentificacion::all();
        $bodegas = Bodega::all();
        $cargos = Cargo::all();
        return view('empleado.create', compact('tipoIdentificaciones', 'bodegas', 'cargos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreemp' => 'required|max:10',
            'apellidoemp' => 'required|max:10',
            'email' => 'required|email|max:20',
            'nro_telefono' => 'required|max:10',
            'direccionemp' => 'required|max:50',
            'ididentificacion' => 'required|exists:tipoidentificaciones,ididentificacion',
            'idbodega' => 'required|exists:bodegas,idbodega',
            'idcargo' => 'required|exists:cargos,idcargo',
        ]);

        Empleado::create($request->all());
        return redirect()->route('empleado.index')->with('success', 'Empleado creado exitosamente.');
    }

    public function edit($idempleado)
    {
        $empleado = Empleado::findOrFail($idempleado);
        $tipoIdentificaciones = TipoIdentificacion::all();
        $bodegas = Bodega::all();
        $cargos = Cargo::all();
        return view('empleado.edit', compact('empleado', 'tipoIdentificaciones', 'bodegas', 'cargos'));
    }

    public function update(Request $request, $idempleado)
    {
        $request->validate([
            'nombreemp' => 'required|max:10',
            'apellidoemp' => 'required|max:10',
            'email' => 'required|email|max:20',
            'nro_telefono' => 'required|max:10',
            'direccionemp' => 'required|max:50',
            'ididentificacion' => 'required|exists:tipoidentificaciones,ididentificacion',
            'idbodega' => 'required|exists:bodegas,idbodega',
            'idcargo' => 'required|exists:cargos,idcargo',
        ]);

        $empleado = Empleado::findOrFail($idempleado);
        $empleado->update($request->all());

        return redirect()->route('empleado.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy($idempleado)
    {
        Empleado::findOrFail($idempleado)->delete();
        return redirect()->route('empleado.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}

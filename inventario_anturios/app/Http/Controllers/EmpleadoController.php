<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\TipoIdentificacion;
use App\Models\Bodega;
use App\Models\Cargo;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $empleados = Empleado::with('tipoIdentificacion', 'bodega', 'cargo')
            ->when($search, function ($query, $search) {
                return $query->where('nombreemp', 'like', "%{$search}%")
                    ->orWhere('nro_identificacion', 'like', "%{$search}%");
            })
            ->paginate(10);

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
            'nombreemp' => 'required|max:50',
            'apellidoemp' => 'required|max:50',
            'email' => 'required|email|max:100',
            'nro_telefono' => 'required|max:20',
            'direccionemp' => 'required|max:255',
            'ididentificacion' => 'required|exists:tipoidentificaciones,ididentificacion',
            'idbodega' => 'required|exists:bodegas,idbodega',
            'idcargo' => 'required|exists:cargos,idcargo',
            'nro_identificacion' => 'required|max:20|unique:empleados,nro_identificacion',
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
        $empleado = Empleado::findOrFail($idempleado);

        $request->validate([
            'nombreemp' => 'required|max:50',
            'apellidoemp' => 'required|max:50',
            'email' => 'required|email|max:100',
            'nro_telefono' => 'required|max:20',
            'direccionemp' => 'required|max:255',
            'ididentificacion' => 'required|exists:tipoidentificaciones,ididentificacion',
            'idbodega' => 'required|exists:bodegas,idbodega',
            'idcargo' => 'required|exists:cargos,idcargo',
            'nro_identificacion' => "required|max:20|unique:empleados,nro_identificacion,$idempleado,idempleado",
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleado.index')->with('success', 'Empleado actualizado exitosamente.');
    }


    public function destroy($idempleado)
    {
        Empleado::findOrFail($idempleado)->delete();

        return redirect()->route('empleado.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}


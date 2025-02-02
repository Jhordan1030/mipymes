<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Bodega;
use App\Models\Cargo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Asegúrate de importar esto

class EmpleadoController extends Controller
{
     //Aqu[i es donde estoy dando permisos
    
     use AuthorizesRequests; 
     public function __construct()
 {
     
     $this->authorizeResource(Empleado::class, 'empleado'); // ✅ Debe coincidir con la ruta
 }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $empleados = Empleado::with('bodega', 'cargo')
            ->when($search, function ($query, $search) {
                return $query->where('nombreemp', 'like', "%{$search}%")
                    ->orWhere('nro_identificacion', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('empleado.index', compact('empleados'));
    }

    public function create()
    {
        $bodegas = Bodega::all();
        $cargos = Cargo::all();
        return view('empleado.create', compact('bodegas', 'cargos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreemp' => 'required|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]+$/',
            'apellidoemp' => 'required|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]+$/',
            'email' => 'required|email|max:100|unique:empleados,email',
            'nro_telefono' => 'required|digits:10',
            'direccionemp' => 'required|string|min:5|max:100',
            'tipo_identificacion' => 'required|in:Cedula,RUC,Pasaporte',
            'nro_identificacion' => 'required',
            'idbodega' => 'required',
            'codigocargo' => 'required|exists:cargos,codigocargo', // Cambio de idcargo a codigocargo
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleado.index')->with('success', 'Empleado creado con éxito.');
    }

    public function edit($nro_identificacion)
    {
        $empleado = Empleado::findOrFail($nro_identificacion);
        $bodegas = Bodega::all();
        $cargos = Cargo::all();

        return view('empleado.edit', compact('empleado', 'bodegas', 'cargos'));
    }

    public function update(Request $request, $nro_identificacion)
    {
        $empleado = Empleado::findOrFail($nro_identificacion);

        $request->validate([
            'nombreemp' => 'required|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]+$/|max:50',
            'apellidoemp' => 'required|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]+$/|max:50',
            'email' => 'required|email|max:100|unique:empleados,email,' . $nro_identificacion . ',nro_identificacion',
            'nro_telefono' => 'required|digits:10',
            'direccionemp' => 'required|string|min:5|max:100',
            'tipo_identificacion' => 'required|in:Cedula,RUC,Pasaporte',
            'nro_identificacion' => 'required',
            'codigocargo' => 'required|exists:cargos,codigocargo', // Cambio de idcargo a codigocargo
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleado.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy($nro_identificacion)
    {
        Empleado::findOrFail($nro_identificacion)->delete();

        return redirect()->route('empleado.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}

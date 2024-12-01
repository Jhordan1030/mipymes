<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $empleados=Empleado::orderBy('id','DESC')->paginate(3);
        return view('empleado.index',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(['cedula_empleado'=>'required', 
            'nombre_empleado'=>'required',
            'apellidos_empleado'=>'required',
            'direccion_empleado'=>'required',
            'telefono_empleado'=>'required',
        ]);
        Empleado::create($request->all());
        return redirect()->route('empleado.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $empleados=Empleado::find($id);
        return  view('empleado.show',compact('empleados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $empleado=empleado::find($id);
        return view('empleado.edit',compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate(['cedula_empleado'=>'required', 
            'nombre_empleado'=>'required',
            'apellidos_empleado'=>'required',
            'direccion_empleado'=>'required',
            'telefono_empleado'=>'required',
        ]);
        $empleado = Empleado::find($id);

        $empleado->update($request->all());

        return redirect()->route('empleado.index')->with('success', 'Registro actualizado satisfactoriamente');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Empleado::find($id)->delete();
        return redirect()->route('empleado.index')->with('success','Registro eliminado satisfactoriamente');
    }
}

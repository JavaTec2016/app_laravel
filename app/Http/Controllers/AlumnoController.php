<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlumnoController extends Controller
{
    //----------------ALTAS
    public function create(){
        return view('insertar');
    }
    public function store(Request $request){
        //validacion

        Alumno::create($request->post());
        Session::flash('message', 'Alumbo agregado');

        return redirect()->route('alumnos.index')->with('message', 'agregado correctamente');
    }

    //--------BAJAS

    public function destroy(Alumno $alumno){
        $alumno->delete();
        Session::flash('message', 'Alumbo eliminado');
        return redirect()->route('alumnos.index');
    }

    //-----------CAMBIUOs

    public function edit(Alumno $alumno){
        return view('editar', compact('alumno'));
    }
    public function update(Request $request, $id){
        $alumno = Alumno::find($id);
        $alumno->num_control = $request->input('num_control');
        $alumno->nombre = $request->input('nombre');
        $alumno->primer_ap = $request->input('primer_ap');
        $alumno->segundo_ap = $request->input('segundo_ap');
        $alumno->fecha_nac = $request->input('fecha_nac');
        $alumno->semestre = $request->input('semestre');
        $alumno->carrera = $request->input('carrera');
        $alumno->save();
        Session::flash('message', 'Modificado');
        return redirect()->route('alumnos.index');
    }

    public function index(Request $request){
        $filtro = $request->input('filtro');

        $alumnos = Alumno::latest()->paginate(4);
        return view('index', compact('alumnos', 'filtro'));
    }
    public function show(Alumno $alumno){
        return view('detalle', compact('alumno'));
    }
}

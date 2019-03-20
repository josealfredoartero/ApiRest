<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\Estudiante;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    // return estudiante::all();
        $estudiantes = estudiante::select('estudiantes.id','estudiantes.nombres','estudiantes.apellidos','estudiantes.DUI','estudiantes.fecha_nacimiento','estudiantes.genero','estudiantes.direccion','estudiantes.telefono','estudiantes.email','c.nombre_cohorte as cohorte','e.nombre_estado as estado')
        ->join('estados as e','e.id','=','estudiantes.id_estado')
        ->join('cohortes as c','c.id','=','estudiantes.id_cohorte')->get();
        return response()->json(['estudiantes'=>$estudiantes]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        //instancia al modelo de estudiante
        $estudiante = new Estudiante;
        //registramos los datos
        $estudiante->nombres=$request->nombres;
        $estudiante->apellidos=$request->apellidos;
        $estudiante->DUI=$request->dui;
        $estudiante->fecha_nacimiento=$request->fechaNac;
        $estudiante->genero=$request->genero;
        $estudiante->direccion=$request->direccion;
        $estudiante->telefono=$request->telefono;
        $estudiante->email=$request->email;
        $estudiante->id_cohorte=1;
        $estudiante->id_estado=1;
   
        try{
                //guardamos los datos en la base de datos
                $estudiante->save();
                return response()->json(['mensaje'=>"dato agregado"]);    
        }catch(\Throwable $th){
            return response()->json(['mensaje'=>"dato no agregado"+$th]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //un dato de la base de datos por su id
        $estudiante=estudiante::findorfail($request->id);
        //actializamos los datos
        $estudiante->nombres = $request->nombres;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->DUI = $request->dui;
        $estudiante->fecha_nacimiento = $request->fechaNac;
        $estudiante->genero = $request->genero;
        $estudiante->direccion = $request->direccion;
        $estudiante->telefono = $request->telefono;
        $estudiante->email = $request->email;
        $estudiante->id_estado=$request->id_estado;
        $estudiante->id_cohorte=$request->id_cohorte;
        try{
            //guardamos cambios
            $estudiante->update();
            return response()->json(['mensaje'=>"dato Modificado"]);    
        }catch(\Throwable $th){
        return response()->json(['mensaje'=>"dato no Modificado"+$th]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        //busqueda por id de un estudiante
        $estudiante=estudiante::findorfail($request->id);
        try{
            //eliminamos el estudiante
            $estudiante->delete();
            return response()->json(['mensaje'=>"dato eliminado"]);    
        }catch(\Throwable $th){
        return response()->json(['mensaje'=>"dato no eliminado"+$th]);
        }
    }

    public function estudiante($request)
    {
        return response()->json(["estudiante"=>estudiante::find($id)]);
    }
   
}

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
        $estudiantes =estudiante::select('estudiantes.id','estudiantes.nombres','estudiantes.apellidos','estudiantes.DUI','estudiantes.fecha_nacimiento','estudiantes.genero','estudiantes.direccion','estudiantes.telefono','estudiantes.email','estados.nombre_estado as estado')
        ->join('estados','estados.id','=','estudiantes.id_estado')
        // ->join('promociones','promociones.id','=','estudiantes.id')
        // ->join('niveles','niveles.id','=','promociones.id_nivel')
        ->get();
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
        $estudiante = new Estudiante;
        // $datos = ["nombres"=>$request->nombres,"apellidos"=>$request->apellidos,"DUI"=>$request->dui,"fecha_nacimiento"=>$request->fechaNac,"genero"=>$request->genero,"direccion"=>$request->direccion,"telefono"=>$request->telefono,"email"=>$request->email,"id_promocion"=>1,"id_estado"=>1];
        // $estudiante = $datos;
        $estudiante->nombres=$request->nombres;
        $estudiante->apellidos=$request->apellidos;
        $estudiante->DUI=$request->dui;
        $estudiante->fecha_nacimiento=$request->fechaNac;
        $estudiante->genero=$request->genero;
        $estudiante->direccion=$request->direccion;
        $estudiante->telefono=$request->telefono;
        $estudiante->email=$request->email;
        $estudiante->id_promocion=1;
        $estudiante->id_estado=1;
        // if($estudiante->save()){
        //     return response()->json(['mensaje'=>"dato agregado"]);
        // }else{
        //     return response()->json(['mensaje'=>"dato no agregado"+$th]);
        // }
        try{
                $estudiante->save();
                return response()->json(['mensaje'=>"dato agregado"]);    
        }catch(\Throwable $th){
            return response()->json(['mensaje'=>"dato no agregado"+$th]);
        }
        // return response()->json(["datos"=>$datos]);
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
        $estudiante=estudiante::findorfail($request->id);
        $estudiante->nombres = $request->nombres;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->DUI = $request->dui;
        $estudiante->fecha_nacimiento = $request->fechaNac;
        $estudiante->genero = $request->genero;
        $estudiante->direccion = $request->direccion;
        $estudiante->telefono = $request->telefono;
        $estudiante->email = $request->email;
        // $estudiante-> = $request->nombres;
        // $estudiante-> = $request->nombres;
        try{
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
        $estudiante=estudiante::findorfail($request->id);
        try{
            $estudiante->delete();
            return response()->json(['mensaje'=>"dato eliminado"]);    
        }catch(\Throwable $th){
        return response()->json(['mensaje'=>"dato no eliminado"+$th]);
        }
    }
   
}

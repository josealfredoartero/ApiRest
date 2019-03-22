<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\Actividad;


class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $actividades = actividad::select('actividads.id','actividads.nombre_actividad as actividad','n.nota as nota','m.nombre as modulo')
        ->join('notas as n','n.id','=','actividads.id_nota')
        ->join('modulos as m','m.id','=','actividads.id_modulo')->get();
        //->join('modulos as m','m.id','=','actividads.id_modulo')->get()->dd();
        return response()->json(['actividades'=>$actividades]);

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
    public function store(Request $request){
        // instancia al modelo de actividades
        $actividad= new Actividad;
        // registramos los datos
        $actividad->nombre_actividad=$request->nombre_actividad;
        $actividad->id_nota=$request->id_nota;
        $actividad->id_modulo=$request->id_modulo;
        try{
            //guardamos los datos en la base de datos
            $actividad->save();
            return response()->json(['mensaje'=>"Datos Agregado"]);
        }catch(\Throwable $th){
            return response()->json(['mensaje'=>"Datos no agregado"+$th]);
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
    public function update(Request $request){
        // un dato de la base de datos por su id
        $actividad = actividad::findorfail($request->id);
        // actualizamos los datos
        $actividad->nombre_actividad = $request->nombre_actividad;
        $actividad->id_nota = $request->id_nota;
        $actividad->id_modulo = $request->id_modulo;
        try{
            // guardamos los cambios
            $actividad->update();
            return response()->json(['mensaje'=>"Dato Modificado"]);
        }catch(\Throwable $th){
            return response()->json(['mensaje'=>"Dato no Modificado"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request){
        //busqueda por id de actividad
        $actividad = actividad::findorfail($request->id);
        try{
            // eliminamos la actividad
            $actividad->delete();
            return response()->json(['mensaje'=>"dato eliminado"]);    
        }catch(\Throwable $th){
        return response()->json(['mensaje'=>"dato no eliminado"]);
        }
    }

    
    public function actividad($request){
        return response()->json(['actividad'=>actividad::find($id)]);
    }

    public function MActividades($request)
    {
        $actividades = Actividad::select("id", "nombre_actividad as actividad")->where('id_modulo',$request)->get();
        return response()->json(["actividades"=>$actividades]);
    }
}

<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\Modulo;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $modulos=Modulo::select('modulos.id','modulos.nombre','docentes.nombre as docente','nivels.nombre_nivel as nivel','cursos.nombre as curso')
        ->join('docentes','docentes.id','=','modulos.id_docente')
        ->join('nivels','nivels.id','=','modulos.id_nivel')
        ->join('cursos','cursos.id','=','modulos.id_curso')->get();
        return response()->json(['modulos'=>$modulos]);
       
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

        // instancia al modelo de modulos
        $modulo= new Modulo;
        // regristro de datos
        $modulo->nombre=$request->nombre;
        $modulo->id_docente=$request->id_docente;
        $modulo->id_nivel=$request->id_nivel;
        $modulo->id_curso=$request->id_curso;

        try{
            // guardamos los datos
            $modulo=save();
            return response()->json(['mensaje'=>"Datos agregado"]);
        }catch(\throwable $th){
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
    public function update(Request $request, $id)
    {
        // un dato de ka db por su id
        $modulo=modulo::findofail($request->id);
        //actualizamos los datos
        $modulo->nombre=$request->nombre;
        $modulo->id_docente=$request->id_docente;
        $modulo->id_nivel=$request->id_nivel;
        $modulo->id_curso=$request->id_curso;

        try{
            //aguardamos los cambios
            $modulo->update();
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
    public function destroy(){
        // busqueda de id por modulo
        $modulo=modulo::findorfail($request->id);
        try{
            //eliminar modulo
            $modulo->delete();
            return response()->json(['mensaje'=>"dato eliminado"]); 
        }catch(\Throwable $th){
            return response()->json(['mensaje'=>"dato no eliminado"]);
        }
    }

    public function modulo($request){
        return response()->json(["modulo"=>modulo::find($id)]);
    }
}

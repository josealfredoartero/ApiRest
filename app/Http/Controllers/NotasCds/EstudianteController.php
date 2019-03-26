<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\Estudiante;
use App\Model\NotasCds\nota;
use App\Model\NotasCds\Modulo;

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
        return response()->json(['mensaje'=>"dato no Modificado"]);
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
        $estudiante = estudiante::findorfail($request->id);
        try{
            //eliminamos el estudiante
            $estudiante->delete();
            return response()->json(['mensaje'=>"dato eliminado"]);    
        }catch(\Throwable $th){
        return response()->json(['mensaje'=>"dato no eliminado"]);
        }
    }

    public function estudiante($id)
    {
        return response()->json(["estudiante"=>estudiante::find($id)]);
    }

    public function estudiantes($id)
    {
        $estudiantes= Estudiante::select("estudiantes.id","estudiantes.nombres",'estudiantes.apellidos')->join('cohortes as c','c.id', '=', 'estudiantes.id_cohorte')
        ->where('c.id',$id)->get();
        return response()->json(["estudiantes"=>$estudiantes]);
    }

    public function estudianteNota($id)
    {
        $estudiante = estudiante::all("id","nombres","apellidos")->where("id",$id);
        foreach ($estudiante as $item) {
            $modulo=[];
            $modulos=[];
            $modul = nota::select("m.id","m.nombre as modulo")->join("estudiantes as e","e.id","=","notas.id_estudiante")
            ->join("actividads as a","a.id","=","notas.id_actividad")->join("modulos as m","m.id","=","a.id_modulo")->orderby("id")->where("e.id",$item->id)->get();
            $n="";
            foreach ($modul as $s) {
                if($n == ""){
                    $modulos[]=$s;
                    $n = $s;
                }
                if($s != $n){
                    $modulos[]=$s;
                    $n=$s;
                }
            }
             foreach ($modulos as $value) {
                // if($modulo == null){
                    $notas=nota::select("a.nombre_actividad as actividad","notas.nota")->join("actividads as a","a.id","notas.id_actividad")
                    ->join("modulos as m","m.id","=","a.id_modulo")->where("m.id",$value["id"])->get();
                    $modulo[]=["id"=>$value->id,"modulo"=>$value->modulo,"notas"=>$notas];
             }
            $item["modulos"]=$modulo;
        } 
        return response()->json(["estudiante"=>$estudiante]);

    }
   
}

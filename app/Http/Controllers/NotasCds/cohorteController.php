<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\Cohorte;
use App\Model\NotasCds\Curso_nivels;

class CohorteController extends Controller
{

    public function __construct(){
        // $this->middleware('jwt');
        // $this->middleware(["jwt","permisoRol:estudiante"],["only"=>["estudianteNota","EstudianteUser"]]);
        // $this->middleware(["jwt","permisoRol:docente"], ["only"=>["CNModulo","NotasModulo"]]);
        // $this->middleware(['jwt','permisoRol:admin']);
        // $this->middleware(['jwt','permisoRol:estudiante'], ['except' => ['store']]);
    }


    public function index()
    {
        return response()->json(["cohortes"=>cohorte::all("id","nombre_cohorte as cohorte")]);
    }

    //agregar cohorte
    public function store(Request $request)
    {   
        if($request["nombre"] && $request["fechaInicio"] && $request["id_curso"] !== null){
        
        try {
            //instancia al modelo
            $cohorte = new cohorte;

            //agregamos los datos
            $cohorte->nombre_cohorte = $request->nombre;
            $cohorte->fechaInicio = $request->fechaInicio;

            //guardamos los campos
            if($cohorte->save()){
                //ultima insercion
                $cohortes = cohorte::select()->get();
                $ultimo = $cohortes->last();
                //insercion de niveles por cohorte
                for ($i=1; $i <= 3; $i++) { 
                $nuevo = new Curso_nivels;
                $nuevo->id_nivel=1;
                $nuevo->id_cohorte=$ultimo["id"];
                $nuevo->id_curso=$request["id_curso"];
                $nuevo->save();
                }
            }
            
            // return response()->json("dato guardado");
            return response()->json(["mensaje"=>"Dato Agregado"]);
        } catch (\Throwable $th) {
            return response()->json(["mensaje"=>"Dato No Agregado".$idUltimo]);
        }
        }else{
            return response()->json(["mensaje"=>"Datos no completos"]);
        }
    }

    public function update(Request $request)
    {
        $cohorte = cohorte::find($request->id);
        $cohorte->nombre_cohorte = $request->nombre;
        $cohorte->fechaInicio = $request->fechaInicio;
        try {
            $cohorte->update();
            return response()->json(["mensaje"=>"Dato Agregado"]);
        } catch (\Throwable $th) {
            return response()->json(["mensaje"=>"Dato No Agregado"]);
        }
    }

    public function destroy($request)
    {
        $cohorte = cohorte::find($request->id);
        try {
            $cohorte->update();
            return response()->json(["mensaje"=>"Dato Agregado"]);
        } catch (\Throwable $th){
            return response()->json(["mensaje"=>"Dato No Agregado"]);
        }
    }

    public function nota()
    {
        return response()->json(nota::all());
    }

    public function CohorteCurso()
    {
        //muestra el curso con la corhote
        $cohorte= cohorte::select("cohortes.id as id_cohorte","cohortes.nombre_cohorte as cohorte","c.id as id_curso","c.nombre as curso")
        ->join("curso_nivels as n","n.id_cohorte","=","cohortes.id")
        ->join("cursos as c","c.id","=","n.id_curso")->get();
        $cohortes=[];
        foreach ($cohorte as $item) {
            if(in_array($item,$cohortes)){
            }else{
                //nombre de la activiad
                $cohortes[]=$item;
            }
        }
        sort($cohortes);
        
        //retornando datos
        return response()->json(["cohortes"=>$cohortes]);
    }
}

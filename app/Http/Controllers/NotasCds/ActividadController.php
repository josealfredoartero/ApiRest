<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\Actividad;


class ActividadController extends Controller
{
    public function index(){
        $actividades = actividad::select('actividads.id','actividads.nombre_actividad as actividad','n.nota as nota','m.nombre as modulo')
        ->join('notas as n','n.id','=','actividads.id_nota')
        ->join('modulos as m','m.id','=','actividads.id_modulo')->get();
        //->join('modulos as m','m.id','=','actividads.id_modulo')->get()->dd();
        return response()->json(['actividades'=>$actividades]);

    }

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

    public function actividades()
    {
        $actividades = Actividad::select("id", "nombre_actividad as actividad")->where('id_modulo',1)->get();
        return response()->json(["actividades"=>$actividades]);
        // echo "dsnfweiofjew";
    }
}

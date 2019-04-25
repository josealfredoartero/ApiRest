<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\nota;
use App\Model\NotasCds\Estudiante;


class NotaController extends Controller
{
    public function __construct(){
        // $this->middleware(["jwt"]);
        // $this->middleware(["jwt","permisoRol:estudiante"],["only"=>["estudianteNota","EstudianteUser"]]);
        // $this->middleware(["jwt","permisoRol:docente"], ["only"=>["CNModulo","NotasModulo"]]);
        // $this->middleware(['jwt','permisoRol:admin']);
        // $this->middleware(['jwt','permisoRol:estudiante'], ['except' => ['store']]);
    }
    
    public function index()
    {
        // $n=0;
        // $not = nota::select("nota")->where("id_actividad",1)->where("id_estudiante",1)->get();
        // foreach ($not as $key) {
        //     $n=$key["nota"];
        // }
        // echo $n;
        // return response()->json($n);
    }

    public function store(Request $request)
    {
        //
    }
    //modificar nota de un estudiante
    public function modificar(Request $request)
    {
        // try {
            $not = nota::select()->where("id_estudiante",$request["id_estudiante"])
            ->where("id_actividad",$request["id_actividad"])->get()->last();
            
            $nota= nota::findorfail($not["id"]);
            $nota->id_estudiante = $request["id_estudiante"];
            $nota->id_actividad = $request["id_actividad"];
            $nota->nota = $request["nota"];
            $nota->update();
            return response()->json($nota);
            // $nota->update();

        //     return response()->json(["mensaje"=> "dato modificado"]);
        // } catch (\Throwable $th) {
        //     return response()->json(["mensaje"=>"Dato No Modificado"]);
        // }
        
    }

    public function destroy($id)
    {
        //
    }

    //funcion para guardar notas
    public function guardar(request $request)
    {
        //condicion de los datos 
        if($request["datos"] !== null){
        try{
            //recorriendo el arreglo
            foreach ($request["datos"] as $item){
                $notas = new nota;
                $notas->id_estudiante = $item["id_estudiante"];
                $notas->id_actividad = $item['id_actividad'];
                $notas->nota = $item['nota'];               //guardamos los datos en la base de datos
                $notas->save(); 
            }  
            return response()->json(['mensaje'=>"dato agregado"]);    
        }catch(\Throwable $th){
            return response()->json(['mensaje'=>"dato no agregado",$th]);
        }
    }else{
        return response()->json(["mensaje"=>"no se pudo procesar la peticion"]);
    }
    }

    public function estudiantesnotas(request $request)
    {
        $estudiantes = estudiante::select("id", "nombres", "apellidos")->where("id_cohorte",$request["id_cohorte"])->get();

        foreach ($estudiantes as $estudiante) {
            $nota = nota::select("nota")->where("id_actividad",$request["id_actividad"])->where("id_estudiante",$estudiante["id"])->get()->last();
            $estudiante["nota"] = $nota["nota"];
        }
        return response()->json(["datos"=>$estudiantes]);
    }

    public function ModificarNotas(request $request)   
    {
        foreach ($request["datos"] as $item) {
            $not = nota::select()->where("id_estudiante",$item["id_estudiante"])
            ->where("id_actividad",$item["id_actividad"])->get()->last();
            
            $nota= nota::find($not["id"]);
            $nota->nota = $item["nota"];
            $nota->update();
        }

        return response()->json("datos Modificados");
    }

}

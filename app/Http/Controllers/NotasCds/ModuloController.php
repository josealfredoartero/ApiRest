<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\Modulo;
use App\Model\NotasCds\Estudiante;
use App\Model\NotasCds\nota;

class ModuloController extends Controller
{
    public function __construct(){
        // $this->middleware(["jwt"]);
        // $this->middleware(["jwt","permisoRol:docente"], ["only"=>["CNModulo","NotasModulo"]]);
        // $this->middleware(['jwt','permisoRol:admin']);
        // $this->middleware(['jwt','permisoRol:estudiante'], ['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //lista de modulos
    public function index(){
        //consulta de todos los modulos
        $modulos=Modulo::select('modulos.id','modulos.nombre','docentes.nombre as docente','nivels.nombre_nivel as nivel','cursos.nombre as curso')
        ->join('docentes','docentes.id','=','modulos.id_docente')
        ->join('nivels','nivels.id','=','modulos.id_nivel')
        ->join('cursos','cursos.id','=','modulos.id_curso')->get();
        return response()->json(['modulos'=>$modulos]);
       
    }

    public function store(Request $request){
        
        //validacion que los datos no vengan vacios
         if($request->nombre && $request->id_docente && $request->id_nivel && $request->id_curso  != NULL ){
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
            }else{
                return response()->json(["mensaje"=>"Petición no procesada"]); 
            }
     

    }

    public function update(Request $request, $id){
    //Validacion que los campos no vengan vacios
    if($request->id  && $request->nombre && $request->id_docente && $request->id_nivel && $request->id_curso  != NULL){
            // un dato de ka db por su id
            $modulo=modulo::findofail($request->id);
            //actualizamos los datos
            $modulo->nombre=$request->nombre;
            $modulo->id_docente=$request->id_docente;
            $modulo->id_nivel=$request->id_nivel;
            $modulo->id_curso=$request->id_curso;

            try{
                //guardamos los cambios
                $modulo->update();
                return response()->json(['mensaje'=>"dato Modificado"]);
            }catch(\Throwable $th){
                return response()->json(['mensaje'=>"dato no Modificado"+$th]);
            }
    }else{
        return response()->json(["mensaje"=>"Petición no procesada"]); 
    }
        

    }

    public function destroy(request $request){
        //Validacion de campos nulos
        if($request->id != NULL){
             // busqueda de id por modulo
            $modulo=modulo::findorfail($request->id);
            try{
                //eliminar modulo
                $modulo->delete();
                return response()->json(['mensaje'=>"dato eliminado"]); 
            }catch(\Throwable $th){
                return response()->json(['mensaje'=>"dato no eliminado"]);
            }
        }else{
            return response()->json(["mensaje"=>"Petición no procesada"]);  
        }
       
    }

    //consulta de un modulo
    public function modulo(request $request){
        //Validacion que los datos no vengan nulos
        if($request->id !=  NULL){
            return response()->json(["modulo"=>modulo::find($request->id)]);
        }else{           
            return response()->json(["mensaje"=>"Petición no procesada"]); 
        }
        
    }

   //modulos por nivel y curso
    public function CNModulo(request $request)    
    {   //Validacion que los datos no vengan nulos
        if($request->id_nivel && $request->id_curso != NULL){
             //consulta
            $modulo = Modulo::select("id","nombre as modulo")->where('id_nivel',$request->id_nivel)->where('id_curso',$request->id_curso)->get();
             return response()->json(["modulos"=>$modulo]);
        }else{
            return response()->json(["mensaje"=>"Petición no procesada"]); 
        }
       
    }
    
    // notas de estudiantes por modulo
    public function NotasModulo(request $request){
        //Validacion que los datos no vengan nulos
        if($request["id_cohorte"] && $request["id_modulo"] != null){

        // todos los estudiantes por cohorte
        $estudiantes = estudiante::select("id","nombres","apellidos")->where("id_cohorte",$request["id_cohorte"])->get();
        $modulo= "";
        $titulos=[];
        $activida=[];
        // foreach de estudiantes para agregar las notas de ese estudiante
        foreach ($estudiantes as $value) {
            $notas=[];
            $promedio=0;
            $notasss= 0;
            // $porcentage=1;
            //actividades por el modulo
            $actividades=Modulo::select("a.id","a.nombre_actividad as nombre","modulos.id as id_modulo","modulos.nombre as modulo","a.ponderacion as ponderacion")
            ->join("actividads as a","a.id_modulo","=","modulos.id")
            ->where("modulos.id",$request["id_modulo"])->get();
            //foreach de las actividades para sacar notas
            foreach ($actividades as $item) {
                //nombre del modulo
                $modulo = $item["modulo"];
                $id_modulo=$item->id_modulo;
                if(in_array($item->nombre,$activida)){
                }else{
                    //nombre de la activiad
                    $activida[]=$item->nombre;
                }
                //nota a su una actividad
                $not = nota::select("nota")->where("id_actividad",$item["id"])->where("id_estudiante",$value["id"])->get();

                foreach ($not as $key) {
                $notasss = $notasss + ($key["nota"]*$item["ponderacion"]);
                }
                //agregando las notas a la variable
                $notas[] = $not;

            }
            //convertir el promedio con solamente un decimal
            $promedio = bcdiv($notasss, 1, 1);

            //agregando las notas al alumno
            $value["notas"]=$notas;
            $value["promedio"]=$promedio;
            $titulos["modulo"]=$modulo;
            $titulos["actividades"]=$activida;    
        }
        //datos de todos los estudiantes con sus notas
        $datos=["titulos"=>$titulos,"estudiantes"=>$estudiantes];

        return response()->json($datos);
    }else {
        return response()->json(["mensaje"=>"peticion no procesada"]);
    }
    }

    
}

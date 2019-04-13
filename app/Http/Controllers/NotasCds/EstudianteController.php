<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\Estudiante;
use App\Model\NotasCds\nota;
use App\Model\NotasCds\modulo;
use App\Model\NotasCds\curso;
use App\Model\NotasCds\curso_nivels;
use App\User;
use App\Role;
use App\RoleUser;

class EstudianteController extends Controller
{
    public function __construct(){
        // $this->middleware(["jwt"]);
        // $this->middleware(["jwt","permisoRol:estudiante"],["only"=>["estudianteNota","EstudianteUser"]]);
        // $this->middleware(["jwt","permisoRol:docente"], ["only"=>["CNModulo","NotasModulo"]]);
        // $this->middleware(['jwt','permisoRol:admin']);
        // $this->middleware(['jwt','permisoRol:estudiante'], ['except' => ['store']]);
    }
    //lista de estudiantes
    public function index()
    {
        //lista de todos los estudiantes
        $estudiantes = estudiante::select('estudiantes.id','estudiantes.nombres','estudiantes.apellidos','estudiantes.DUI','estudiantes.fecha_nacimiento','estudiantes.genero','estudiantes.direccion','estudiantes.telefono','estudiantes.email','c.nombre_cohorte as cohorte','e.nombre_estado as estado')
        ->join('estados as e','e.id','=','estudiantes.id_estado')
        ->join('cohortes as c','c.id','=','estudiantes.id_cohorte')->get();
        return response()->json(['estudiantes'=>$estudiantes]);
    }

    public function store(request $request)
    {
        //validacion de los datos
        if($request["nombres"] && $request["apellidos"] && $request["dui"] && $request["fechaNac"] &&
        $request["genero"] && $request["direccion"] && $request["telefono"] && $request["email"] &&
        $request["id_cohorte"] != null){
            try{
                    //instancia al modelo de user para agregar un user 
                    $user = new User;
                    $user->name=($request->nombres." ".$request->apellidos);
                    $user->email=$request->email;
                    //encriptar la conteseña
                    $user->password=bcrypt("12345678");
                    //condicion si se guarda el usuario
                    if($user->save()){
                        //rol de estudiante
                        $rolEstudiante=Role::select()->where("name","estudiante")->get();
                        //instancia a roles por user
                        $rol = new RoleUser;
                        //consulta del ultimo user ingresado
                        $users= User::select()->get();
                        $ultimoUser=$users->last();
                        //insertar un role por user
                        $rol->user_id=$ultimoUser["id"];
                        $rol->role_id=$rolEstudiante["id"];
                        if($rol->save()){
                            $nombres= strtoupper($request["nombres"]);
                            $apellidos=strtoupper($request["apellidos"]);
                            //instancia al modelo de estudiante
                            $estudiante = new Estudiante;
                            //registramos los datos
                            $estudiante->nombres=$nombres;
                            $estudiante->apellidos=$apellidos;
                            $estudiante->DUI=$request->dui;
                            $estudiante->fecha_nacimiento=$request->fechaNac;
                            $estudiante->genero=$request->genero;
                            $estudiante->direccion=$request->direccion;
                            $estudiante->telefono=$request->telefono;
                            $estudiante->email=$request->email;
                            $estudiante->id_cohorte=$request->id_cohorte;
                            $estudiante->id_estado=1;
                            $estudiante->id_user=$ultimoUser["id"];
                            //guardamos nuevo estudiante
                            $estudiante->save();
                        }
                    // $user->roles()->attach(Role::where('name',  $request->input('rol'))->first());
                }
                    //retorno
                    return response()->json(['mensaje'=>"dato agregado"]);    
                }catch(\Throwable $th){
                    //retorno
                    return response()->json(['mensaje'=>"dato no agregado"+$th]);
                }
        }else{
            //retorno
            return response()->json(["mensaje"=>"Datos incompletos"]);
        }
    } 
//modificar datos del estudiante
    public function update(Request $request)
    {
        if($request["id"] && $request["nombres"] && $request["apellidos"] && $request["dui"] && $request["fechaNac"] && $request["genero"] && $request["direccion"] && $request["telefono"] && $request["email"] && $request["id_estado"] && $request["id_cohorte"] != null){
            try{
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
            //guardamos cambios
            $estudiante->update();
                return response()->json(['mensaje'=>"Dato Modificado"]);    
            }catch(\Throwable $th){
                return response()->json(['mensaje'=>"Dato no Modificado"]);
            }
        }else{
            return response()->json(["mensaje"=>"Complete todos los campos"]);
        }
        
    }
    //eliminar estudiante
    public function destroy(request $request)
    {   //Peticion no procesada
        if($request->id != NULL){
            //busqueda por id de un estudiante
            $estudiante = estudiante::findorfail($request->id);
            try{
                //eliminamos el estudiante
                $estudiante->delete();
                return response()->json(['mensaje'=>"Dato Eliminado"]);    
            }catch(\Throwable $th){
            return response()->json(['mensaje'=>"Dato no Eliminado"]);
            }
        }else{
            return response()->json(['mensaje'=>"Petición no procesada"]);
        }
       
    }
    //busqueda de un estudiante
    public function estudiantes($id)
    {
        if($id !=null){
        $estudiantes = Estudiante::select("estudiantes.id","estudiantes.nombres",'estudiantes.apellidos')->join('cohortes as c','c.id', '=', 'estudiantes.id_cohorte')
        ->where('c.id',$id)->get();
        $cont=1;
        foreach ($estudiantes as $key) {
            $key["nota"] =$cont;
            $cont ++;
        }
        return response()->json(["estudiantes"=>$estudiantes]);
    }
    }
    //consulta de las notas por un estudiante
    public function estudianteNota(request $request)
    {
        //condicion
        if($request["id_estudiante"] !=  null){

        try {
            if($request["id_nivel"]==null){
                $request["id_nivel"]=1;
            }
            //consulta de el estudiante por id
            $estudiante = estudiante::select("id","nombres","apellidos")->where("id",$request->id_estudiante)->get();
            //cohorte del estudiante
            $cohorte = estudiante::select("c.id")->join("cohortes as c","c.id","=","estudiantes.id_cohorte")
            ->where("estudiantes.id",$request->id_estudiante)->get();

            $modulo=[];
            $nivel ="";
            $curso="";
            $idC="";
            $id_curso="";

            foreach ($cohorte as $c) {
                //curso de la cohorte del estudiante
                $id_curso = curso::select("cursos.id")->join("curso_nivels as s","s.id_curso","=","cursos.id")
                ->where("s.id_cohorte",$c["id"])->get();
                foreach ($id_curso as $id_c) {
                    $idC = $id_c["id"];
                }
            }
            //modulos del curso
            $modulos = modulo::select("modulos.id","modulos.nombre as modulo","c.nombre as curso","n.nombre_nivel")->join("nivels as n","n.id","=","modulos.id_nivel")
            ->join("cursos as c","c.id","=","modulos.id_curso")
            ->where("n.id",$request->id_nivel)->where("c.id",$idC)->get();
            
            foreach ($modulos as $value) {
                //nombre del curso
                $curso =$value["curso"];
                //nivel
                $nivel=$value["nombre_nivel"];
                //notas de las actividades por modulo
                $notas=nota::select("a.nombre_actividad as actividad","notas.nota")->join("actividads as a","a.id","notas.id_actividad")
                ->join("modulos as m","m.id","=","a.id_modulo")->where("m.id",$value["id"])->where("id_estudiante",$request["id_estudiante"])->get();
                $modulo[]=["modulo"=>$value["modulo"],"notas"=>$notas];
            }
            foreach ($estudiante as $key) {
                //datos adicionales al estudiante
                $key["curso"]=$curso;
                $key["nivel"]=$nivel;
                $key["modulos"]=$modulo;
            }
            //retorno de la consulta con las notas de un estudiante
            return response()->json(["estudiante"=>$estudiante]);
    
        } catch (\Throwable $th) {
            return response()->json(["mensaje"=>"error".$th]);
        }
       
        }else{
            return response()->json(["mensaje"=>"datos incompletos para realizar la peticion"]);
        }
    }

    //consulta de los datos de un usuario logiado
    public function EstudianteUser(request $request)
    {
        //condicion de datos
        if($request["id_user"] != null){
            try {
                //datos del estudiante del rol estudiante
                $estudianteUser= estudiante::select("*")->where("id_user",$request["id_estudiante"])->get();
                //retorno de los datos
                return response()->json(["estudianteUser"=>$estudianteUser]);
            } catch (\Throwable $th) {
                return response()->json(["error"=>"error peticion no procesada"]);
            }
        }else{
            response()->json(["mensaje"=>"error no se pudo realizar la peticion"]);
        }
    }
   
}
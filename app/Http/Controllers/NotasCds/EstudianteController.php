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
    public function index()
    {
        //
    // return estudiante::all();
        $estudiantes = estudiante::select('estudiantes.id','estudiantes.nombres','estudiantes.apellidos','estudiantes.DUI','estudiantes.fecha_nacimiento','estudiantes.genero','estudiantes.direccion','estudiantes.telefono','estudiantes.email','c.nombre_cohorte as cohorte','e.nombre_estado as estado')
        ->join('estados as e','e.id','=','estudiantes.id_estado')
        ->join('cohortes as c','c.id','=','estudiantes.id_cohorte')->get();
        return response()->json(['estudiantes'=>$estudiantes]);
    }

    public function store(request $request)
    {
        if($request["nombres"] && $request["apellidos"] && $request["dui"] && $request["fechaNac"] &&
        $request["genero"] && $request["direccion"] && $request["telefono"] && $request["email"] &&
        $request["id_cohorte"] !== null){
            try{
                    $user = new User;
                    $user->name=($request->nombres." ".$request->apellidos);
                    $user->email=$request->email;
                    $user->password=bcrypt("12345678");
                    if($user->save()){
                        $rol = new RoleUser;
                        $users= User::select()->get();
                        $ultimoUser=$users->last();
                        $rol->user_id=$ultimoUser["id"];
                        $rol->role_id=1;
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
                            $estudiante->save();
                        }
                    // $user->roles()->attach(Role::where('name',  $request->input('rol'))->first());
                }
                    return response()->json(['mensaje'=>"dato agregado"]);    
                }catch(\Throwable $th){
                    return response()->json(['mensaje'=>"dato no agregado"+$th]);
                }
        }else{
            return response()->json(["mensaje"=>"Datos incompletos"]);
        }
    } 

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

    public function destroy(request $request)
    {
        //busqueda por id de un estudiante
        $estudiante = estudiante::findorfail($request->id);
        try{
            //eliminamos el estudiante
            $estudiante->delete();
            return response()->json(['mensaje'=>"Dato Eliminado"]);    
        }catch(\Throwable $th){
        return response()->json(['mensaje'=>"Dato no Eliminado"]);
        }
    }

    public function estudiantes($id)
    {
        $estudiantes = Estudiante::select("estudiantes.id","estudiantes.nombres",'estudiantes.apellidos')->join('cohortes as c','c.id', '=', 'estudiantes.id_cohorte')
        ->where('c.id',$id)->get();
        $cont=1;
        foreach ($estudiantes as $key) {
            $key["nota"] =$cont;
            $cont ++;
        }
        return response()->json(["estudiantes"=>$estudiantes]);
    }

    public function estudianteNota(request $request)
    {
        $estudiante = estudiante::select("id","nombres","apellidos")->where("id",$request->id_estudiante)->get();
        $cohorte = estudiante::select("c.id")->join("cohortes as c","c.id","=","estudiantes.id_cohorte")
        ->where("estudiantes.id",$request->id_estudiante)->get();
        $modulo=[];
        $nivel ="";
        $curso="";
        $idC="";
        $id_curso="";
        foreach ($cohorte as $c) {
            $id_curso = curso::select("cursos.id")->join("curso_nivels as s","s.id_curso","=","cursos.id")
            ->where("s.id_cohorte",$c["id"])->get();
            foreach ($id_curso as $id_c) {
                $idC = $id_c["id"];
            }
        }

        $modulos = modulo::select("modulos.id","modulos.nombre as modulo","c.nombre as curso","n.nombre_nivel")->join("nivels as n","n.id","=","modulos.id_nivel")
        ->join("cursos as c","c.id","=","modulos.id_curso")
        ->where("n.id",$request->id_nivel)->where("c.id",$idC)->get();
        
        foreach ($modulos as $value) {
            $curso =$value["curso"];
            $nivel=$value["nombre_nivel"];
            $notas=nota::select("a.nombre_actividad as actividad","notas.nota")->join("actividads as a","a.id","notas.id_actividad")
            ->join("modulos as m","m.id","=","a.id_modulo")->where("m.id",$value["id"])->where("id_estudiante",$request["id_estudiante"])->get();
            $modulo[]=["modulo"=>$value["modulo"],"notas"=>$notas];
        }
        foreach ($estudiante as $key) {
            $key["curso"]=$curso;
            $key["nivel"]=$nivel;
            $key["modulos"]=$modulo;
        }
        return response()->json(["estudiante"=>$estudiante]);

    //     $estudiante = estudiante::all("id","nombres","apellidos")->where("id",$id);
    //     foreach ($estudiante as $item) {
    //         $modulo=[];
    //         $modulos=[];
    //         $modul = nota::select("m.id","m.nombre as modulo")->join("estudiantes as e","e.id","=","notas.id_estudiante")
    //         ->join("actividads as a","a.id","=","notas.id_actividad")->join("modulos as m","m.id","=","a.id_modulo")->orderby("id")->where("e.id",$item->id)->get();
    //         $n="";
    //         foreach ($modul as $s) {
    //             if($n == ""){
    //                 $modulos[]=$s;
    //                 $n = $s;
    //             }
    //             if($s != $n){
    //                 $modulos[]=$s;
    //                 $n=$s;
    //             }
    //         }
    //          foreach ($modulos as $value) {
    //                 $notas=nota::select("a.nombre_actividad as actividad","notas.nota")->join("actividads as a","a.id","notas.id_actividad")
    //                 ->join("modulos as m","m.id","=","a.id_modulo")->where("m.id",$value["id"])->get();
    //                 $modulo[]=["id"=>$value->id,"modulo"=>$value->modulo,"notas"=>$notas];
    //          }
    //         $item["modulos"]=$modulo;
    //     } 
    //     return response()->json(["estudiante"=>$estudiante]);

    }
   
}
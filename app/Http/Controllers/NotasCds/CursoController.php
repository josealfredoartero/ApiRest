<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\Curso;

class cursoController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        return response()->json(["curso"=>Curso::select("id", "nombre")->get()]);
    }
    
    public function create(){
        // return view('cursos.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // crear la instancia a el modelo
        $cursos= new curso;

        // guardar el nombre que trae el request 
        $cursos->nombre = $request->nombre;

        // mandar los cambios a la base de datos
        $cursos->save();
        return response()->json(['mensaje'=>"Dato agregado"]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //buscar cursos
        $curso=curso::findorfail($id);

        return view('cursos.update',compact('curso'));
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
        $curso=curso::findorfail($id);
        // retornar una vista con los datos de la base de datos
        return view('cursos.update',compact('curso'));
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
        // 
        $cursos=curso::findorfail($id);
        $cursos->nombre=$request->nombre;
        if ($cursos->update() == true) {
            return "Dato guardado";
        }else{
            return "Dato No Guardado";
        }
        // $cursos->update();
        // return redirect('/inicio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //consulta datos con id
        $cursos=curso::findorfail($id);
        //condicion si elimino 
        if ($cursos->delete() == true) {
            return "Dato Eliminado";
            // return redirect('/inicio');
        }else{
            return "Dato no Eliminado";
        }
    }

    public function cohorte(request $request)
    {
        $cohorte = curso::select("c.id","c.nombre_cohorte as cohorte", "cn.id_nivel")
        ->join('curso_nivels as cn','cn.id_curso','=','cursos.id')
        ->join('cohortes as c','c.id','=','cn.id_cohorte')->where("cursos.id",$request->id_curso)->where("cn.id_nivel",1)
        ->get();
        return response()->json(["cohortes"=>$cohorte]);
    }
}

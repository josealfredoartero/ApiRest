<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\controllers\Controller;
use App\Model\NotasCds\estudiante;


class promocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promocion= Promocion::select('promociones.id', 'niveles.nombre_nivel as nivel', 'cohortes.nombre_cohorte as cohorte','cursos.nombre as curso')
        ->join('niveles','niveles.id','=' ,'promociones.id_nivel')
        ->join('cohortes','cohortes.id','=' ,'promociones.id_cohorte')
        ->join('cursos','cursos.id','=','promociones.id_curso')->get();
        return  response()->json(['promocion'=>$promocion]);

        

        //  $estudiantes = estudiante::select('estudiantes.id','estudiantes.nombre','estudiantes.DUI','estudiantes.fecha_nacimiento','estudiantes.genero','estudiantes.direccion','estudiantes.telefono','estudiantes.email','estados.nombre_estado')
        // //  ->join('promociones','promociones.id','=','estudiante.id_promocion')
        //  ->join('estados','estados.id','=','estudiantes.id_estado')->get();
        // return response()->json(['estidiantes'=>$estudiantes]);

        //consultas relacionales en la base de datos mysql
        // $promociones = DB::table('promociones')
        // ->join('niveles','niveles.id', '=' , 'promociones.id_nivel')
        // ->join('cursos','cursos.id','=','promociones.id_curso')
        // ->join('cohortes','cohortes.id','=','promociones.id_cohorte')
        // ->select('promociones.id','niveles.nombre_nivel as nivel', 'cursos.nombre as curso','cohortes.nombre_cohorte as cohorte')->get();
        // foreach ($promociones as $n){
        //     echo  "$n->id $n->cohorte $n->nivel $n->curso<br>";

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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\controllers\Controller;
use App\Model\NotasCds\estudiante;
use App\Model\NotasCds\Curso_nivels;



class Curso_nivelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CursoNivels= Curso_nivels::select('curso_nivels.id', 'niveles.nombre_nivel as nivel', 'cohortes.nombre_cohorte as cohorte','cursos.nombre as curso')
        ->join('niveles','niveles.id','=' ,'curso_nivels.id_nivel')
        ->join('cohortes','cohortes.id','=' ,'curso_nivels.id_cohorte')
        ->join('cursos','cursos.id','=','curso_nivels.id_curso')->get();
        return  response()->json(['CursoNivels'=>$CursoNivels]);

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

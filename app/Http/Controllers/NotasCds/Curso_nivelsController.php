<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\controllers\Controller;
use App\Model\NotasCds\curso;
use App\Model\NotasCds\Curso_nivels;



class Curso_nivelsController extends Controller
{
    public function __construct(){
        // $this->middleware(["jwt"]);
        // $this->middleware(["jwt","permisoRol:estudiante"],["only"=>["estudianteNota","EstudianteUser"]]);
        // $this->middleware(["jwt","permisoRol:docente"], ["only"=>["CNModulo","NotasModulo"]]);
        // $this->middleware(['jwt','permisoRol:admin']);
        // $this->middleware(['jwt','permisoRol:estudiante'], ['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CursoNivels= Curso_nivels::select('curso_nivels.id', 'nivels.nombre_nivel as nivel', 'cohortes.nombre_cohorte as cohorte','cursos.nombre as curso')
        ->join('nivels','nivels.id','=' ,'curso_nivels.id_nivel')
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

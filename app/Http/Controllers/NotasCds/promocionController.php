<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Model\NotasCds\Promocion;
use App\Http\controllers\controller;
use DB;

class promocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $r= Promocion::select('promociones.id', 'niveles.nombre_nivel as nivel', 'cohortes.nombre_cohorte as cohorte')
        // ->join('niveles','niveles.id','=' ,'promociones.id_nivel')
        // ->join('cohortes','cohortes.id','=' ,'promociones.id_cohorte')->get();
        // foreach ($pr as $p){
        //     echo $p .'<br>';
        // }
            return Promocion::all();

        //consultas relacionales en la base de datos mysql
        // $promociones = DB::table('promociones')
        // ->join('niveles','niveles.id', '=' , 'promociones.id_nivel')
        // ->join('cursos','cursos.id','=','promociones.id_curso')
        // ->join('cohortes','cohortes.id','=','promociones.id_cohorte')
        // ->select('promociones.id','niveles.nombre_nivel as nivel', 'cursos.nombre as curso','cohortes.nombre_cohorte as cohorte')->get();
        // foreach ($promociones as $n){
        //     echo  "$n->id $n->cohorte $n->nivel $n->curso<br>";
        // }
        // foreach($promociones as $promocion){
        //     echo $promocion->id_nivel."<br>";
        // }
        // return $promociones;
        // echo $promociones->nivel.$promociones->curso.$promociones->cohorte.'<br>';
        // foreach($promociones as $n){
        //     $id = $n->id;
        //     if($n->id_curso==$n->curso->id){
        //         $curso = $n->curso->nombre;
        //     };
        //     if($n->id_nivel==$n->nivel->id){
        //         $nivel = $n->nivel->nombre_nivel;
        //     };
        //     echo "$id $curso $nivel<br>";
        // }

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

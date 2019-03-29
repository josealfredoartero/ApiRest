<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\Cohorte;

class CohorteController extends Controller
{
    public function index()
    {
        return response()->json(["cohortes"=>cohorte::all("id","nombre_cohorte as cohote")]);
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
        $cohorte = new cohorte;
        $cohorte->nombre_cohorte = $request->nombre;
        
        $cohorte->fechaInicio = $request->fechaInicio;
        try {
            $cohorte->save();
            return response()->json(["mensaje"=>"Dato Agregado"]);
        } catch (\Throwable $th) {
            return response()->json(["mensaje"=>"Dato No Agregado"]);
        }

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
    public function update(Request $request)
    {
        $cohorte = cohorte::find($request->id);
        $cohorte->nombre_cohorte = $request->nombre;
        $cohorte->fechaInicio = $request->fechaInicio;
        try {
            $cohorte->update();
            return response()->json(["mensaje"=>"Dato Agregado"]);
        } catch (\Throwable $th) {
            return response()->json(["mensaje"=>"Dato No Agregado"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        $cohorte = cohorte::find($request->id);
        try {
            $cohorte->update();
            return response()->json(["mensaje"=>"Dato Agregado"]);
        } catch (\Throwable $th){
            return response()->json(["mensaje"=>"Dato No Agregado"]);
        }
    }

    public function nota()
    {
        return response()->json(nota::all());
    }
}

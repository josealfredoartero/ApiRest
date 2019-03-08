<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;


class RolController extends Controller
{

    public function __construct()
    {
        $this->middleware(array('jwt','permisoRol:admin'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $datos=Role::all();
        return response()->json(['datos'=>$datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return View('roles.agregar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        // $registro = new Role();
        // $registro->name = $request->input('name');
        // $registro->description = $request->input('descripcion');
        // $registro->save();
        // return redirect('roles');
  try {
    $this->validate($request,[ 'name'=>'required', 'description'=>'required']);
    Role::create($request->all());
    return response()->json(['success'=>'Registro creado satisfactoriamente']);
  } catch (\Throwable $th) {
    return response()->json(['error'=>'Registro  no guardado']);
  }
        
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dato=Role::find($id);
        return response()->json(['dato'=>$dato]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $this->validate($request,[ 'name'=>'required', 'description'=>'required']);
        Role::find($id)->update($request->all());
        return response()->json(['success'=>'Registro actualizado satisfactoriamente']);
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        return response()->json(['success'=>'Registro eliminado satisfactoriamente']);

    }
}

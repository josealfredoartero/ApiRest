<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\curso;

class cursosController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //llamar todos los datos de la base de datos
        $cursos=curso::all();
        // if (isset($mensaje)){
        //     return view('cursos.listar',compact('cursos','mensaje'));
            
        // }else{
        //     return view('cursos.listar',compact('cursos'));
        // }
        //retornamos el dato que se encuentra en el nombre
        return view('cursos.listar',compact('cursos'));
    }
    public function create(){
        return view('cursos.insert');
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
        if($cursos->save() == true){
            return "<script>
            window.alert('DATO AGREGADO');
            window.location.href='/inicio';
            </script>";
            // return redirect("/inicio/{'mensaje'=>$mensaje}");
            // return view('cursos.listar',compact('cursos','mensaje'));
            // return Redirect::to('/inicio');
            // route::('id','cursosController@index');
        }else{
            return "<script>
            window.alert('DATO NO AGREGADO');
            window.location.href='/inicio';
            </script>";
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
            return "<script>
            window.alert('DATO MODIFICADO');
            window.location.href='/inicio';
            </script>";
        }else{
            return "<script>
            window.alert('DATO NO AGREGADO');
            window.location.href='/inicio';
            </script>";
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
            return "<script>
            window.alert('DATO ELIMINADO');
            window.location.href='/inicio';
            </script>";
            // return redirect('/inicio');
        }else{
            return "<script>
            window.alert('DATO NO ELIMINADO');
            window.location.href='/inicio';
            </script>";
        }
    }
}
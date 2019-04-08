<?php

namespace App\Http\Controllers\NotasCds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\NotasCds\nota;


class NotaController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function guardar(request $request)
    {
        try{
            foreach ($request->datos as $item){
                $notas = new nota;
                // echo $item->nota;
                $notas->id_estudiante = $item["id_estudiante"];
                $notas->id_actividad = $item['id_actividad'];
                $notas->nota = $item['nota'];
                //guardamos los datos en la base de datos
                $notas->save(); 
            }  
            return response()->json(['mensaje'=>"dato agregado"]);    
        }catch(\Throwable $th){
            return response()->json(['mensaje'=>"dato no agregado",$th]);
        }
    }
    
}

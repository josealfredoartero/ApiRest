<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function __construct()
    {
      
     $this->middleware('jwt');
    }

    public function all()
    {
        return response()->json(['productos'=>Producto::all()]);
    }
}

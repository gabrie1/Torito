<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categoria;

class TestController extends Controller
{
    public function index()
    {
        //$categorias=Categoria::all();
        $categorias = ['nombre'=>"Paul", "apellido"=>"Miranda"];
        return response()->json($categorias, 200);
    }
}

//creo que era eso
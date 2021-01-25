<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class MapController extends Controller
{
    public function gmaps()
    {
	
		
		//$registros = DB::table('registros')->get();
		$listado = DB::table('ubicaciones')
		->select('nombre')
		->orderBy('nombre', 'desc')
		->groupBy('nombre')
		->get();
		//dd($nombres);
		
		$nombres= $listado->toArray();
		//dd($nombres);

    	return view('gmaps',compact('nombres'));
		//return view('gmaps',compact('registros'));
		

	}
	
	public	function rutas(Request $request){
		//$nombre = $request->get('nombre');
		//return response()->json(['response' => 'This is get method']);
	//	dd($nombre);
		$nombre = $request->get('nombre');

		$puntos = DB::table('ubicaciones')
		->where('nombre', $nombre)
		->get();
		//dd($request->get('nombre'));
		
		//echo json_encode($listado->toArray());
		return response()->json(['rutas' => $puntos->toArray(),'status'=>'ok']);

    	

}
/*	public function guno()
    {
    	//$registros = DB::table('registros')->get();
		/*$registros = DB::table('ubicaciones')
		->select('nombre  = ')
		->get();
  
		
		$registros = DB::table('ubicaciones' WHERE nombre = santa ')->get();
		

		//return view('gmaps',compact('registros'));
    }*/
}

<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cajera;

class CajeraController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/cajera",
    *     summary="Mostrar Propiedades Ganaderas",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos las propiedades."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function index()
    {
        $arreglo=array();
        $cajeras=Cajera::all();
          foreach($cajeras as $cajera){
                $test = [
            'id'=> $cajera->idCategoria,
            'nombre'=> $cajera->nombre,
            'imagen'=> base64_encode( $cajera->imagen ),
           ];
          $arreglo['propiedad'][]=$test;
        }
        return response()->json($arreglo, 200);
    }

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

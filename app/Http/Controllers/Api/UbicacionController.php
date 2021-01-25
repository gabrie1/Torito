<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ubicacion;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          //
          $arreglo=array();
          $ubicaciones=Ubicacion::all();
            foreach($ubicaciones as $ubicacion){
                  $test = [
              'id'=> $ubicacion->id,
              'nombre'=>$ubicacion->nombre,
              'fecha'=>$ubicacion->fecha,
              'lat'=> $ubicacion->lat,
              'lng'=>$ubicacion->lng,
             ];
            $arreglo['ubicacion'][]=$test;
         }
         return response()->json($arreglo, 200);
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
    public function mostrar(Request $request,  $nombre){
        //
        $ubicaciones=Ubicacion::where("nombre", $nombre)->get();

       return response()->json($ubicaciones, 200);

       /*
        $test = [
            'id'=> $ubicaciones[]['id'],
            'nombre'=>$ubicaciones[]['nombre'],
            'fecha'=>$ubicaciones[]['fecha'] ,
            'lat'=> $ubicaciones[]['lat'] ,
            'lng'=>$ubicaciones[]['lng'] ,
        ];*/

        //var_dump($categorias[0]);
        //supongo que es por eso que ta lanzando error hay que codificarlo como lo hace en el ejemplo
        //exit();
      //  $categorias = ['nombre'=>"Paul", "apellido"=>"Miranda"];
        //return response()->json($categorias, 200);
    // return response()->json($test, 200);
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request->all obtiene todos los campos que se envia por el rest
        $data = $request->all();
        // Esto es solo para validar podemos ovbiarlo por el momento
        //Creamos una instancia de ubicacion$ubicacion y seteamos los atributos
        $ubicacion = new Ubicacion();

        $ubicacion->nombre= $request->input('nombre');
        $ubicacion->fecha= $request->input('fecha');
        $ubicacion->lat= $request->input('lat');
        $ubicacion->lng = $request->input('lng');

      //sip ahora nunca hice enviar imagen por rest apijejeje
      //pero seguro que pillamos algo en internet anda buscando y yo voy viendo por aqui en mi pc
      //ok
       // ahora la imagen como lo trabajamos
       //hagamos la prueba primero los datos y luego investigamos de la imagen? haz la prueba con el postman haber
       //ok espera
       // El $request->input son los datos que envias desde postman esta bien lo has cambiado
       //pero estos con $ubicacion->lat son los campos de tabla en la base de datos
        //Guardamos
        //asi lo pruevo
        // sip
        if ($ubicacion->save()) {
            //Si todo sale bien devolvemos un mensaje el el codigo 201 significa que se creo correctamente algo
            //la familia 200 son devoluciones correctas
            $message = [
                'message' => 'ubicacion$ubicacion created',
                'ubicacion$ubicacion' => $ubicacion
            ];
            return response()->json($message, 201);
        }

        $response = [
            'message' => 'Error durante la creación'
        ];
        //la familia 400 el navegador lo interpreta como problemas o que no existe en esta caso 404
        // la familia 500 son errores ya sea de servidor ode programación
        return response()->json($response, 404);
        //para probar debes de poner en el postman los valores a estos campos
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

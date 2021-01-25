<?php


namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Publicacion;
class PublicacionController extends Controller
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
        $publicaciones=Publicacion::all();
          foreach($publicaciones as $publicacion){
                $test = [
            'contenido'=> $publicacion->contenido,
            'latitud'=> $publicacion->latitud,
            'longitud'=>$publicacion->longitud,
            'idCategoria'=>$publicacion->idCategoria,
            'idUsuario'=>$publicacion->idUsuario,
           'propietario'=>$publicacion->propietario,
            'telefono'=>$publicacion->telefono,
            'fecha'=>$publicacion->fecha,
            'mascota'=>$publicacion->mascota,

             'genero'=>$publicacion->genero,
            'imagen'=> base64_encode( $publicacion->imagen ),
            'imagen2'=> base64_encode( $publicacion->imagen2 ),
           ];
          $arreglo['categoria'][]=$test;
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
        /*
        $this->validate($request,[

            'category_id'  => 'required',
            'contenido'    => 'required',
            'lat'          => 'required',
            'lng'          => 'required',
            'uv_id'        => 'required'
        ]);

        $category_id = $request->input('category_id');
        $contenido = $request->input('contenido');
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $uv_id = $request->input('uv_id');
        */

        //Creamos una instancia de publicacion y seteamos los atributos
        $publicacion = new Publicacion();
        $publicacion->contenido= $request->input('contenido');
        $publicacion->latitud= $request->input('latitud');
        $publicacion->longitud = $request->input('longitud');
        $publicacion->idCategoria = $request->input('idCategoria');
        $publicacion->idUsuario= $request->input('idUsuario');
        $publicacion->propietario= $request->input('propietario');
        $publicacion->telefono= $request->input('telefono');
        $publicacion->fecha= $request->input('fecha');
        $publicacion->mascota= $request->input('mascota');
        $publicacion->genero= $request->input('genero');
    ///  $publicacion->imagen = $request->input('imagen');
      //  $publicacion->imagen2 = $request->input('imagen2');
      //ahora solo falta las imagenes
      //sip ahora nunca hice enviar imagen por rest apijejeje
      //pero seguro que pillamos algo en internet anda buscando y yo voy viendo por aqui en mi pc
      //ok

       // ahora la imagen como lo trabajamos
       //hagamos la prueba primero los datos y luego investigamos de la imagen? haz la prueba con el postman haber
       //ok espera
       // El $request->input son los datos que envias desde postman esta bien lo has cambiado
       //pero estos con $publicacion->lat son los campos de tabla en la base de datos
        //Guardamos
        //asi lo pruevo
        // sip
        if ($publicacion->save()) {
            //Si todo sale bien devolvemos un mensaje el el codigo 201 significa que se creo correctamente algo
            //la familia 200 son devoluciones correctas
            $message = [
                'message' => 'Publicacion created',
                'publicacion' => $publicacion
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

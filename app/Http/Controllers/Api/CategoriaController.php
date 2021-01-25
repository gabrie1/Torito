<?php
// Controllers es el directorio por defecto cuando creas otro suibdirctorio
// debes agregarlo al namespace
namespace App\Http\Controllers\Api;
//poseemos problema no se por que sale eso
// lo bueno esq ya reconose la ruta 
// eso no me salia creare otro proyecto
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categoria;

// debemos agregar la clase de la cual extiende el controlador
class CategoriaController extends Controller
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
        $categorias=Categoria::all();
          foreach($categorias as $categoria){
                $test = [
            'id'=> $categoria->id,
            'nombre'=> $categoria->Nombre,
            'imagen'=> base64_encode( $categoria->imagen ),
           ];
          $arreglo['categoria'][]=$test;
       }
       return response()->json($arreglo, 200);
       /* $test = [
            'id'=> $categorias[1]['id'],
            'nombre'=> $categorias[1]['Nombre'],
            'imagen'=> base64_encode( $categorias[1]['imagen'] ),
        ];*/
        //var_dump($categorias[0]);
        //supongo que es por eso que ta lanzando error hay que codificarlo como lo hace en el ejemplo
        //exit();
      //  $categorias = ['nombre'=>"Paul", "apellido"=>"Miranda"];
        //return response()->json($categorias, 200);
   
        //Ahora si el problemita con la consulta parece con el blob
        // porque guardas un archivo en la base datos?
        //son imagenes
        // no es mejor guardarlas en un directorio?puej como solo las insertare por la 
        //base de datos son 6 iamgens de categoria q tendre en publicacion so cada ves q 
        //publique algo subire una imagen tengo un ejemplo pero no esta en laravel
        //y asi lo queria hacer te lo muestro mira
    // mira aca es donde hago mi consulta ah la base de  datos y por eso sale 
    // el error q te dije esq tengo un imagen el la base de datos 
    /*foreach($categorias as $categoria){
        return response()->json($categoria->Nombre,200) ;
    }*/
       
    }
    public function mostrar($id){
         //
         $categorias=Categoria::all();
         $test = [
             'id'=> $categorias[$id]['id'],
             'nombre'=> $categorias[$id]['Nombre'],
             'imagen'=> base64_encode( $categorias[$id]['imagen'] ),
         ];
         //var_dump($categorias[0]);
         //supongo que es por eso que ta lanzando error hay que codificarlo como lo hace en el ejemplo
         //exit();
         $categorias = ['nombre'=>"Paul", "apellido"=>"Miranda"];
         //return response()->json($categorias, 200);
         return response()->json($test, 200);
    }
    public function leer(){
        $categorias=Categoria::all();
        return $categorias;
       // foreach($categorias as $categoria){
          //  echo  $categoria->Nombre;
      //  }
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

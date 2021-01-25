<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

// para implementacion de jwt
// https://www.positronx.io/laravel-jwt-authentication-tutorial-user-login-signup-api/

// para documentar con swagger
// https://ivankolodiy.medium.com/how-to-write-swagger-documentation-for-laravel-api-tips-examples-5510fb392a94
// https://styde.net/como-documentar-una-api-en-laravel-usando-swagger/

class AuthController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'start']]);
    }
	/**
	* @OA\Post(
	* path="/api/auth/login",
	* summary="autenticacion de usuario",
	* description="Ingrese correo electronico y contraseña",
	* tags={"auth"},
	* @OA\RequestBody(
	*    required=true,
	*    description="Credenciales de usuario",
	*    @OA\JsonContent(
	*       required={"email","password"},
	*       @OA\Property(property="email", type="string"),
	*       @OA\Property(property="password", type="string", format="password", example="123456789")
	*    ),
	* ),
	* @OA\Response(
	*    response=422,
	*    description="Credenciales incorrectas",
	*    @OA\JsonContent(
	*       @OA\Property(property="message", type="string", example="Usuario y/o contraseña incorrectas.")
	*        )
	* ),
	*
	* @OA\Response(
	*    response=401,
	*    description="No autorizado",
	*    @OA\JsonContent(
	*       @OA\Property(property="message", type="string", example="Usuario no autorizado.")
	*        )
	* )
	*
	* )
	*/
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Usuario no autorizado'], 401);
        }

        return $this->createNewToken($token);
    }

	/**
	 * @OA\Post(
	 * path="/api/auth/register",
	 * summary="crea un nuevo usuario",
	 * description="Ingrese email y contraseña",
	 * tags={"auth"},
	 * @OA\RequestBody(
	 *    required=true,
	 *    description="Crea nuevo usuario",
	 *    @OA\JsonContent(
	 *       required={"name","email","password", "password_confirmation"},
	 *       @OA\Property(property="name", type="string"),
	 *       @OA\Property(property="email", type="string"),
	 *       @OA\Property(property="password", type="string", format="password", example="123456789"),
	 *       @OA\Property(property="password_confirmation", type="string", format="password", example="123456789")
	 *    ),
	 * ),
    *  @OA\Response(
    *         response=201,
    *         description="Se creo exitosamente el usuario."
    *     ),	 
	 * @OA\Response(
	 *    response=400,
	 *    description="Credenciales no validas",
	 *    @OA\JsonContent(
	 *       @OA\Property(property="message", type="string")
	 *        )
	 *     )
	 * )
	 */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'Usuario registrado correctamente.',
            'user' => $user
        ], 201);
    }

    /**
    * @OA\Get(
    * 	  path="/api/auth/logout",
    *     tags={"auth"},
    *     security={{ "apiAuth": {} }},
    *     summary="Cierra session de usuario",
    *     @OA\Response(
    *         response=200,
    *         description="Session cerrada correctamente."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     ),
	*     )
    * )
    */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'Usuario cerró session correctamente.']);
    }


    /**
    * @OA\Get(
    * 	  path="/api/auth/start",
    *     tags={"auth"},
    *     summary="Usuario no autorizado",
    *     @OA\Response(
    *         response=401,
    *         description="No tiene autorizacion.",
	*    	  @OA\JsonContent(
	*       	@OA\Property(property="message", type="string", example="No autorizado"),
	*         )
    *     )
    * )
    */
    public function start()
    {    	
        return response()->json(['success' => 'Usuario No autorizado!'], 200);
    }

    /**
    * @OA\Get(
    * 	  path="/api/auth/list",
    *     tags={"auth"},
    *     security={{ "apiAuth": {} }},
    *     summary="Mostrar lista de usuarios",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los usuarios."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     ),
	* 	  @OA\Response(
	*    	response=401,
	*    	description="Respuesta si el usuario no esta autorizado",
	*    	@OA\JsonContent(
	*       	@OA\Property(property="message", type="string", example="No autorizado"),
	*       )
	*     )
    * )
    */
    public function list()
    {    	
        $arreglo = array();
        $usuarios = User::all();
        foreach($usuarios as $user){
	   		array_push($arreglo, $user->name);
        }
        return response()->json($arreglo, 200);
    }

    /**
     * Refresca el token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
    * @OA\Get(
    * 	  path="/api/auth/user-profile",
    *     tags={"auth"},
    *     security={{ "apiAuth": {} }},
    *     summary="Mostrar usuario autenticado",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los usuarios."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function userProfile() {
        return response()->json(auth()->user());
    }


    /**
     * obtiene la estructura del token
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}

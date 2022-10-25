<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login de Usuarios y generación de token",
     *     description="Ingreso al sistema de información mediante: email, contraseña y nombre del dispositivo. Si los datos son correctos, el sistema de devolvera un token para ser usado.",
     *     operationId="authLogin",
     *     tags={"Auth"},
     *
     *     @OA\Parameter(
     *      name="email",in="query",required=true,
     *      description="Correo electrónico, que actua como usuario",
     *      @OA\Schema(type="string",default="citesbolivia@gmail.com")
     *     ),
     *     @OA\Parameter(
     *      name="password",in="query",required=true,
     *      description="Contraseña proporcionada por el administrador",
     *      @OA\Schema(type="string",default="password")
     *     ),
     *     @OA\Parameter(
     *      name="name",in="query",required=true,
     *      description="Nombre del dispositivo de donde se esta conectando, por ejemplo: iphone10,firefox-win10,etc.",
     *      @OA\Schema(type="string",default="webapp-001")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Se autentifico con éxito",
     *         @OA\JsonContent(
     *              @OA\Property(property="token", type="string", example="885|4lzLzFRZwxoEVVBJYr8FggntJCWBVBUPJaOgqEXIxxx"),
     *              @OA\Property(property="message", type="string", example="success"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="No autorizado",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthorized"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="entidad no procesable, Campos necesarios no enviados",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(property="errors", type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="email",type="string",example="The email field is required."),
     *                      @OA\Property(property="password",type="string",example="The password field is required."),
     *                      @OA\Property(property="name",type="string",example="The name field is required.")
     *                  ),
     *              ),
     *         )
     *     ),
     *
     * )
     *
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        // login true
        if(Auth::attempt($request->only('email','password'))){
            return response()->json([
                'token'=> $request->user()->createToken($request->name)->plainTextToken,
                'message'=>'success'
            ]);
        }

        // login false
        return response()->json([
            'message' => 'Unauthorized'
        ],401);

    }
    public function validateLogin(Request $request)
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required'
        ]);
    }
}

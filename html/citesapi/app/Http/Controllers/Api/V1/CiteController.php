<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Cite;
use Illuminate\Http\Request;

use App\Http\Resources\V1\CiteResource;
use App\Http\Resources\V1\CiteCollection;

class CiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/v1/cites/",
     *     summary="Lista de solicitudes CITES generadas",
     *     description="Devuelve la lista de los datos de todas las solicitudes cites generadas en el sistema",
     *     operationId="v1getCitesList",
     *     tags={"V1"},
     *     security={{"bearerAuth":{}}},

     *     @OA\Response(
     *         response=200,
     *         description="Json con datos de la lista de solicitudes CITES",
     *         @OA\JsonContent()
     *
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="No autentificado",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *         )
     *     )
     *
     * )
     *
     */
    public function index()
    {
        return  CiteResource::collection(Cite::all());
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cite  $cite
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/v1/cites/{citesId}",
     *     summary="Buscar una solicitud CITES por ID",
     *     description="Devuelve la información de una ficha de una solicitud CITES específico",
     *     operationId="v1getCites",
     *     tags={"V1"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="citesId",in="path",required=true,
     *      description="ID de la solicitud CITES",
     *      @OA\Schema(type="integer",default="1",format="int64")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Se optiene los datos con éxito",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="No se encontraron datos",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="No autentificado",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *         )
     *     )
     *
     * )
     *
     */

    public function show(Cite $cite)
    {
        return new CiteResource($cite);
    }

}

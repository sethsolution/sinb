<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CatalogoCiteEspecie;
use Illuminate\Http\Request;

use App\Http\Resources\V1\CatalogoCiteEspecieResource;

class CatalogoCiteEspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/v1/list_species_amazon/",
     *     summary="Lista todas las especies CITES amazónicas utilizadas",
     *     description="Lista todas las especies CITES amazónicas utilizadas",
     *     operationId="v1getCitesEspecieList",
     *     tags={"CITES"},
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
     * )
     *
     */
    public function index()
    {
        return CatalogoCiteEspecieResource::collection(CatalogoCiteEspecie::where('tipo','=','1')->get());
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatalogoCiteEspecie  $catalogoCiteEspecie
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/v1/list_species_amazon/{specieId}",
     *     summary="Buscar una especie CITES por ID",
     *     description="Devuelve la información de una especie CITES específico",
     *     operationId="v1getCitesEspecie",
     *     tags={"CITES"},
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
    public function show(CatalogoCiteEspecie $catalogoCiteEspecie)
    {
        return new CatalogoCiteEspecieResource($catalogoCiteEspecie);
    }

}

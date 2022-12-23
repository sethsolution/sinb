<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CatalogoCitesEspecie;
use Illuminate\Http\Request;

use App\Http\Resources\V1\CatalogoCitesEspecieResource;

class CatalogoCitesEspecieController extends Controller
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
        return CatalogoCitesEspecieResource::collection(CatalogoCitesEspecie::where('tipo','=','1')->get());
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatalogoCitesEspecie  $catalogoCiteEspecie
     * @return \Illuminate\Http\Response
     */

    public function show(CatalogoCitesEspecie $catalogoCiteEspecie)
    {
        return new CatalogoCitesEspecieResource($catalogoCiteEspecie);
    }

}

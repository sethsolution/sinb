<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CatalogoCitesProposito;
use Illuminate\Http\Request;

use App\Http\Resources\V1\CatalogoCitesPropositoResource;

class CatalogoCitesPropositoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/v1/list_purpose/",
     *     summary="Lista de Propositos CITES",
     *     description="Devuelve la lista de los datos de solicitudes cites",
     *     operationId="v1getPropositoList",
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
        return CatalogoCitesPropositoResource::collection(CatalogoCitesProposito::all());
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatalogoCitesProposito  $catalogoCitesProposito
     * @return \Illuminate\Http\Response
     */
    //public function show(CatalogoCitesProposito $catalogoCitesProposito)
    public function show($id)
    {
        $proposito = CatalogoCitesProposito::find($id);

        if (is_null($proposito)) {
            $response = [
                'success' => false,
                'message' => 'Proposito not found.',
            ];
            return response()->json($response, '404');
        }

        return new CatalogoCitesPropositoResource($proposito);
    }
}

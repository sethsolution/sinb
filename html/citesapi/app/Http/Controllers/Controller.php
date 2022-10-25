<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *  title="Manejo de información mediante el uso de API"
 *  , version="0.1"
 * )
 * @OA\Schemes(format="http")
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 *      description="Authorization token optienes en 'login' - Auth: /api/login ",
 * ),
 * @OA\Tag(
 *     name="Auth",
 *     description="Auth endpoints",
 * )
 * @OA\Tag(
 *     name="V1",
 *     description="Funcionalidad para acceder a la información de solicitudes CITES",
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

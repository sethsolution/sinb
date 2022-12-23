<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *  title="Manejo de información mediante el uso de API"
 *  , version="1.0.0"
 *  , @OA\Contact(
 *          email="admin@seth.com.bo"
 *      )
 *  ,@OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
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
 *     description="Autentificación",
 * )
 * @OA\Tag(
 *     name="CITES",
 *     description="Consulta toda información recopilada sobre Módulo CITES",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

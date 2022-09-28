<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *    title="EduAPP API documentation",
 *    version="1.0.0",
 * ),
 *
 * @OA\Tag(
 *     name="Authentification",
 *     description="API endpoints for authentification",
 * )
 * @OA\Tag(
 *     name="Student",
 *     description="get student informations"
 * ),
 * @OA\Tag(
 *     name="Attandances",
 *     description="attandance academy"
 * ),
 * @OA\Tag(
 *     name="Appeals",
 *     description="store appeals"
 * )
 *
 */


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

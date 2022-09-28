<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appeal;
use Illuminate\Http\Request;

class AppealsController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/appeals",
     *     operationId="appeals",
     *     summary="store appeals",
     *     description="store appeals from web site",
     *     tags={"Appeals"},
     *     @OA\RequestBody(
     *          required=true,
     *          description="fill in the required fields",
     *          @OA\JsonContent(
     *              required={"name", "phone"},
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="course_id", type="integer"),
     *              @OA\Property(property="address", type="string"),
     *
     *          )
     *     ),
     *     @OA\Response(
     *          response=204,
     *          description="appeal stored !",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Appeal stored"),
     *          )
     *     ),
     *
     * )
     */

    public function store(Request $request)
    {
        $requestData=$request->all();
        $requestData['type']='Web Sayt';
        Appeal::create($requestData);
        return response()->json(['message'=>'Appeal stored'], 204);
    }
}

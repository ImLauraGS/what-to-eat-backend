<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="What to Eat API",
 *     version="1.0",
 *     description="API Documentation for What to Eat application"
 * )
 * @OA\Server(
 *     url="http://127.0.0.1:8000",
 *     description="Local Development Server"
 * )
 */

/**
 * @OA\Schema(
 *     schema="Favorite",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="recipe_id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2023-07-12T00:00:00.000000Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2023-07-12T00:00:00.000000Z"
 *     )
 * )
 */
class SwaggerController extends Controller
{
    // Este controlador puede estar vacío, solo se usa para contener las anotaciones globales de Swagger.
}

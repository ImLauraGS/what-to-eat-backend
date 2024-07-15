<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Recipe;



class FavoriteController extends Controller
{

    /**
    * @OA\Get(
    *     path="/api/favorites/{user_id}",
    *     summary="Get list of favorite recipes for a user",
    *     @OA\Parameter(
    *         name="user_id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Successful operation",
    *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Favorite"))
    *     )
    * )
    */

    public function index($user_id)
    {
        $favorites = Favorite::where('user_id', $user_id)->get();

        return response()->json(['favorites' => $favorites], 200);
    }

     /**
    * @OA\Post(
    *     path="/api/recipe/{id}",
    *     summary="Add a recipe to favorites",
    *     @OA\Parameter(
    *         name="recipe_id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent()
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Recipe added to favorites",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Recipe added to favorites"),
    *             @OA\Property(property="favorite", ref="#/components/schemas/Favorite")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Recipe not found"
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Recipe already added to favorites"
    *     )
    * )
    */
    public function store(Request $request, $recipe_id)
{
    $user_id = $request->user()->id;

    $recipe = Recipe::find($recipe_id);
    if (!$recipe) {
        return response()->json(['message' => 'Recipe not found'], 404);
    }

    $existingFavorite = Favorite::where('user_id', $user_id)
                                ->where('recipe_id', $recipe_id)
                                ->first();

 
    if ($existingFavorite) {
        return response()->json(['message' => 'Recipe already added to favorites'], 400);
    }

    $favorite = Favorite::create([
        'user_id' => $user_id,
        'recipe_id' => $recipe_id,
    ]);

    return response()->json(['message' => 'Recipe added to favorites', 'favorite' => $favorite], 201);
}

 /**
    * @OA\Delete(
    *     path="/api/favorites/{user_id}/{recipe_id}",
    *     summary="Delete a favorite recipe for a user",
    *     @OA\Parameter(
    *         name="user_id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Parameter(
    *         name="recipe_id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Favorite deleted",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Favorite deleted")
    *         )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Favorite not found or error occurred"
    *     )
    * )
    */

public function destroy($user_id, $recipe_id)
{
    try {
        $favorite = Favorite::where('user_id', $user_id)
                            ->where('recipe_id', $recipe_id)
                            ->firstOrFail();

        $favorite->delete();

        return response()->json(['message' => 'Favorite deleted'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Favorite not found or error occurred', 'error' => $e->getMessage()], 404);
    }
}


}

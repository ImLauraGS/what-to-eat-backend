<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Recipe;

class FavoriteController extends Controller
{
    public function index($user_id)
    {
        $favorites = Favorite::where('user_id', $user_id)->get();

        return response()->json(['favorites' => $favorites], 200);
    }
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

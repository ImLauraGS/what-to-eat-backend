<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $recipes=Recipe::all();
            return response()->json($recipes, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al recuperar recetas de la base de datos.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getRecipe($id)
    {
        if (Auth::check()) {
            $recipe = Recipe::findOrFail($id);

            if ($recipe) {
                return response()->json($recipe);
            } else {
                return response()->json(['error' => 'Receta no encontrada'], 404);
            }
        } else {
            return response()->json(['error' => 'No autorizado'], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1500',
        'ingredients' => 'required|string|max:1500',
        'tiktok'=> 'required|string|max:1500',
        'youtube'=> 'required|string|max:1500',
    ]);

    try {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'No autorizado'], 401);
        }

        $recipes = new Recipe();
        $recipes->title = $request->title;
        $recipes->description = $request->description;
        $recipes->ingredients = $request->ingredients;
        $recipes->tiktok = $request->tiktok;
        $recipes->youtube = $request->youtube;


        $user->recipes()->save($recipes);

        return response()->json(['message' => 'La receta se ha añadido correctamente'], 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al añadir la receta', 'error' => $e->getMessage()], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function getUserRecipes()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'No autorizado'], 401);
            }

            $recipes = Recipe::where('user_id', $user->id)->get();

            return response()->json($recipes, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al recuperar las recetas del usuario.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'description' => 'sometimes|required|string|max:1500',
        'ingredients' => 'sometimes|required|string|max:1500',
        'tiktok' => 'sometimes|required|string|max:1500',
        'youtube' => 'sometimes|required|string|max:1500',
    ]);

    try {

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'No autorizado'], 401);
        }


        $recipe = Recipe::findOrFail($id);

        if ($recipe->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado para actualizar esta receta'], 403);
        }

        $recipe->fill($request->only(['title', 'description', 'ingredients', 'tiktok', 'youtube']));
        $recipe->save();

        return response()->json(['message' => 'La receta se ha actualizado correctamente', 'recipe' => $recipe], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al actualizar la receta', 'error' => $e->getMessage()], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'No autorizado'], 401);
            }

            $recipe = Recipe::findOrFail($id);

            if ($recipe->user_id !== $user->id) {
                return response()->json(['message' => 'No autorizado para eliminar esta receta'], 403);
            }

            $recipe->delete();

            return response()->json(['message' => 'La receta se ha eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar la receta', 'error' => $e->getMessage()], 500);
        }
    }
}

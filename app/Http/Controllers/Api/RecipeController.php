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

     /**
    * @OA\Get(
    *     path="/api/recipes",
    *     summary="Get list of recipes",
    *     @OA\Response(
    *         response=200,
    *         description="Successful operation",
    *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Recipe"))
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Error al recuperar recetas de la base de datos."
    *     )
    * )
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
    * @OA\Get(
    *     path="/api/recipes/{id}",
    *     summary="Get a single recipe by ID",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Successful operation",
    *         @OA\JsonContent(ref="#/components/schemas/Recipe")
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Receta no encontrada"
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="No autorizado"
    *     )
    * )
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
    * @OA\Post(
    *     path="/api/add",
    *     summary="Create a new recipe",
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             @OA\Property(property="title", type="string", example="Delicious Cake"),
    *             @OA\Property(property="description", type="string", example="A very delicious cake recipe."),
    *             @OA\Property(property="ingredients", type="string", example="Flour, sugar, eggs, butter")
    *         )
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="La receta se ha añadido correctamente",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="La receta se ha añadido correctamente")
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="No autorizado"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Error al añadir la receta"
    *     )
    * )
    */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1500',
        'ingredients' => 'required|string|max:1500',
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

        $user->recipes()->save($recipes);

        return response()->json(['message' => 'La receta se ha añadido correctamente'], 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al añadir la receta', 'error' => $e->getMessage()], 500);
    }
}

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
    * @OA\Put(
    *     path="/api/recipe/{id}",
    *     summary="Update an existing recipe",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             @OA\Property(property="title", type="string", example="Updated Recipe Title"),
    *             @OA\Property(property="description", type="string", example="Updated recipe description."),
    *             @OA\Property(property="ingredients", type="string", example="Updated ingredients list")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="La receta se ha actualizado correctamente",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="La receta se ha actualizado correctamente")
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="No autorizado"
    *     ),
    *     @OA\Response(
    *         response=403,
    *         description="No autorizado para actualizar esta receta"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Error al actualizar la receta"
    *     )
    * )
    */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:1500',
            'ingredients' => 'sometimes|required|string|max:1500',
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

            $recipe->update($request->only(['title', 'description', 'ingredients']));

            return response()->json(['message' => 'La receta se ha actualizado correctamente', 'recipe' => $recipe], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar la receta', 'error' => $e->getMessage()], 500);
        }
    }

     /**
    * @OA\Delete(
    *     path="/api/recipe/{id}",
    *     summary="Delete a recipe",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="La receta se ha eliminado correctamente",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="La receta se ha eliminado correctamente")
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="No autorizado"
    *     ),
    *     @OA\Response(
    *         response=403,
    *         description="No autorizado para eliminar esta receta"
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Error al eliminar la receta"
    *     )
    * )
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

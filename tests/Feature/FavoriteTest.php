<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Recipe;
use Laravel\Sanctum\Sanctum;

class FavoriteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_index()
    {
        
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $recipe = Recipe::factory()->create();

        Favorite::factory()->create([
            'user_id' => $user->id,
            'recipe_id' => $recipe->id,
        ]);

        $response = $this->get("/api/favorites/{$user->id}");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'favorites',
     
                    ]);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson("/api/recipe/{$recipe->id}");

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Recipe added to favorites',
                 ]);

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'recipe_id' => $recipe->id,
        ]);
    }

    public function test_store_already_favorited()
    {
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create();

        Favorite::factory()->create(['user_id' => $user->id, 'recipe_id' => $recipe->id]);

        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson("/api/recipe/{$recipe->id}");

        $response->assertStatus(400)
                 ->assertJson([
                     'message' => 'Recipe already added to favorites',
                 ]);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create();

        $favorite = Favorite::factory()->create(['user_id' => $user->id, 'recipe_id' => $recipe->id]);

        Sanctum::actingAs($user, ['*']);

        $response = $this->deleteJson("/api/favorites/{$user->id}/{$recipe->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Favorite deleted',
                 ]);

        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'recipe_id' => $recipe->id,
        ]);
    }

    public function test_destroy_not_found()
    {
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $response = $this->deleteJson("/api/favorites/{$user->id}/{$recipe->id}");

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Favorite not found or error occurred',
                 ]);
    }
}

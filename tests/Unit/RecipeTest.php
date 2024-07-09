<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Recipe;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Hash;

class RecipeTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_index()
{
    $user = User::factory()->create([
        'password' => Hash::make('123456789')
    ]);
    $recipes = Recipe::factory()->count(5)->create(['user_id' => $user->id]);

    Sanctum::actingAs($user, ['*']); // Authenticate the user

    $response = $this->getJson('/api/recipes');

    $response->assertStatus(200)
             ->assertJsonCount(5);
}

    public function test_store()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/add', [
            'title' => 'Test Recipe',
            'description' => 'Test Description',
            'ingredients' => 'Test Ingredients',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'La receta se ha añadido correctamente',
                 ]);

        $this->assertDatabaseHas('recipes', [
            'title' => 'Test Recipe',
            'description' => 'Test Description',
            'ingredients' => 'Test Ingredients',
            'user_id' => $user->id,
        ]);
    }
}

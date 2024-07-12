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
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_index()
{
    $user = User::factory()->create([
        'password' => Hash::make('123456789')
    ]);
    $recipes = Recipe::factory()->count(5)->create(['user_id' => $user->id]);

    Sanctum::actingAs($user, ['*']); 

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

    public function test_getRecipe(){
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create(['user_id' => $user->id]);

        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson("/api/recipe/{$recipe->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $recipe->id,
                     'title' => $recipe->title,
                     'description' => $recipe->description,
                     'ingredients' => $recipe->ingredients,
                     'user_id' => $user->id,
                 ]);
    }
    
    public function test_update(){
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create(['user_id' => $user->id]);

        Sanctum::actingAs($user, ['*']);
        
        $response = $this->putJson("/api/recipe/{$recipe->id}", [
            'title' => 'Updated Recipe',
            'description' => 'Updated Description',
            'ingredients' => 'Updated Ingredients',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'La receta se ha actualizado correctamente',
                 ]);

        $this->assertDatabaseHas('recipes', [
            'id' => $recipe->id,
            'title' => 'Updated Recipe',
            'description' => 'Updated Description',
            'ingredients' => 'Updated Ingredients',
            'user_id' => $user->id,
        ]);
    }

    public function test_destroy(){
        
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create(['user_id' => $user->id]);

        Sanctum::actingAs($user, ['*']);

        $response = $this->deleteJson("/api/recipe/{$recipe->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'La receta se ha eliminado correctamente',
                 ]);

        $this->assertDatabaseMissing('recipes', [
            'id' => $recipe->id,
        ]);
    }
}

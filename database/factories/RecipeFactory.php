<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(100), 
            'description' => $this->faker->text(100), 
            'ingredients' => $this->faker->text(100), 
            'tiktok'=>$this->faker->text(25), 
            'youtube'=>$this->faker->text(25), 
            'user_id' => User::factory(),
        ];
    }
}

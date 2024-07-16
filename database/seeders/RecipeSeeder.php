<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = [
            [
                'user_id' => 1, 
                'title' => 'Pollo al Curry',
                'description' => "1. Calentar aceite en una sartén.\n2. Añadir cebolla picada y cocinar hasta dorar.\n3. Agregar pechugas de pollo en cubos y dorar.\n4. Añadir pasta de curry y mezclar bien.\n5. Incorporar leche de coco y cocinar a fuego lento hasta que el pollo esté cocido.\n6. Servir con arroz.",
                'ingredients' => "Pollo, Cebolla, Curry, Leche de coco, Aceite, Sal, Pimienta",
                'tiktok' => 'https://www.tiktok.com/@user/pollo_al_curry',
                'youtube' => 'https://www.youtube.com/watch?v=pollo_al_curry',
            ],
            [
                'user_id' => 1, 
                'title' => 'Ensalada César',
                'description' => "1. Lavar y cortar la lechuga romana.\n2. Preparar la salsa mezclando mayonesa, ajo, mostaza, limón y anchoas.\n3. Tostar pan en cubos con aceite y ajo.\n4. Mezclar la lechuga con la salsa.\n5. Añadir los crutones y queso parmesano rallado.",
                'ingredients' => "Lechuga romana, Mayonesa, Ajo, Mostaza, Limón, Anchoas, Pan, Aceite, Queso parmesano",
                'tiktok' => 'https://www.tiktok.com/@user/ensalada_cesar',
                'youtube' => 'https://www.youtube.com/watch?v=ensalada_cesar',
            ],
            [
                'user_id' => 1, 
                'title' => 'Tacos de Carnitas',
                'description' => "1. Cocinar la carne de cerdo con cebolla, ajo, y especias hasta que esté tierna.\n2. Desmenuzar la carne y dorarla en una sartén.\n3. Calentar las tortillas.\n4. Servir la carne en las tortillas con cebolla picada, cilantro, y limón.",
                'ingredients' => "Carne de cerdo, Cebolla, Ajo, Especias, Tortillas, Cilantro, Limón",
                'tiktok' => 'https://www.tiktok.com/@user/tacos_de_carnitas',
                'youtube' => 'https://www.youtube.com/watch?v=tacos_de_carnitas',
            ],
            [
                'user_id' => 1, 
                'title' => 'Spaghetti a la Boloñesa',
                'description' => "1. Cocinar la carne molida con cebolla y ajo hasta dorar.\n2. Añadir tomate triturado y especias.\n3. Cocinar a fuego lento por 30 minutos.\n4. Cocer el spaghetti según las instrucciones.\n5. Mezclar la salsa con el spaghetti y servir con queso rallado.",
                'ingredients' => "Spaghetti, Carne molida, Cebolla, Ajo, Tomate, Especias, Queso",
                'tiktok' => 'https://www.tiktok.com/@user/spaghetti_bolonesa',
                'youtube' => 'https://www.youtube.com/watch?v=spaghetti_bolonesa',
            ],
            [
                'user_id' => 1, 
                'title' => 'Sushi de Salmón',
                'description' => "1. Cocer arroz para sushi y mezclar con vinagre de arroz.\n2. Cortar salmón en tiras finas.\n3. Extender el arroz sobre una hoja de alga nori.\n4. Colocar el salmón sobre el arroz y enrollar.\n5. Cortar en piezas y servir con salsa de soja.",
                'ingredients' => "Arroz para sushi, Vinagre de arroz, Salmón, Alga nori, Salsa de soja",
                'tiktok' => 'https://www.tiktok.com/@user/sushi_de_salmon',
                'youtube' => 'https://www.youtube.com/watch?v=sushi_de_salmon',
            ],
            [
                'user_id' => 1, 
                'title' => 'Gazpacho Andaluz',
                'description' => "1. Pelar y cortar los tomates, pepino, pimiento y cebolla.\n2. Triturar los ingredientes con ajo, aceite de oliva y vinagre.\n3. Pasar la mezcla por un colador.\n4. Enfriar en la nevera.\n5. Servir con trozos de verduras y pan.",
                'ingredients' => "Tomate, Pepino, Pimiento, Cebolla, Ajo, Aceite de oliva, Vinagre, Pan",
                'tiktok' => 'https://www.tiktok.com/@user/gazpacho_andaluz',
                'youtube' => 'https://www.youtube.com/watch?v=gazpacho_andaluz',
            ],
            [
                'user_id' => 1, 
                'title' => 'Brownies de Chocolate',
                'description' => "1. Derretir mantequilla con chocolate.\n2. Mezclar con azúcar y huevos.\n3. Añadir harina y cacao en polvo.\n4. Verter la mezcla en un molde.\n5. Hornear a 180°C por 25 minutos.\n6. Dejar enfriar y cortar en cuadros.",
                'ingredients' => "Mantequilla, Chocolate, Azúcar, Huevos, Harina, Cacao en polvo",
                'tiktok' => 'https://www.tiktok.com/@user/brownies_chocolate',
                'youtube' => 'https://www.youtube.com/watch?v=brownies_chocolate',
            ],
            [
                'user_id' => 1, 
                'title' => 'Paella Valenciana',
                'description' => "1. Dorar pollo y conejo en una paellera.\n2. Añadir judías verdes, tomate y pimentón.\n3. Incorporar arroz y caldo de pollo.\n4. Cocinar a fuego medio hasta que el arroz esté hecho.\n5. Decorar con pimientos y limón.",
                'ingredients' => "Pollo, Conejo, Judías verdes, Tomate, Pimentón, Arroz, Caldo de pollo, Pimientos, Limón",
                'tiktok' => 'https://www.tiktok.com/@user/paella_valenciana',
                'youtube' => 'https://www.youtube.com/watch?v=paella_valenciana',
            ],
            [
                'user_id' => 1, 
                'title' => 'Hummus Clásico',
                'description' => "1. Triturar garbanzos cocidos con tahini, ajo, limón y aceite de oliva.\n2. Añadir agua hasta obtener la consistencia deseada.\n3. Sazonar con sal y comino.\n4. Servir con pan pita y verduras.",
                'ingredients' => "Garbanzos, Tahini, Ajo, Limón, Aceite de oliva, Sal, Comino, Pan pita, Verduras",
                'tiktok' => 'https://www.tiktok.com/@user/hummus_clasico',
                'youtube' => 'https://www.youtube.com/watch?v=hummus_clasico',
            ],
            [
                'user_id' => 1, 
                'title' => 'Pizza Margarita',
                'description' => "1. Extender la masa de pizza.\n2. Cubrir con salsa de tomate.\n3. Añadir mozzarella y albahaca fresca.\n4. Hornear a 220°C por 15 minutos.\n5. Servir caliente.",
                'ingredients' => "Masa de pizza, Salsa de tomate, Mozzarella, Albahaca",
                'tiktok' => 'https://www.tiktok.com/@user/pizza_margarita',
                'youtube' => 'https://www.youtube.com/watch?v=pizza_margarita',
            ],
        ];

        foreach ($recipes as $recipe) {
            Recipe::create($recipe);
        }
    }
}

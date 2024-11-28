<?php

namespace Database\Factories;

use App\Models\Shape;
use Illuminate\Database\Eloquent\Factories\Factory;

 
class ShapeFactory extends Factory
{
    protected $model = Shape::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'area' => $this->faker->randomFloat(2, 10, 500), // مساحة بين 10 و 500
            'material_id' => null, // يتم تحديدها عند الاستدعاء في Seeder
        ];
    }
}
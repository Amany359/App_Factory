<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        // إنشاء بيانات تجريبية
        $materials = [
            ['name' => 'Steel', 'description' => 'High strength material.'],
            ['name' => 'Wood', 'description' => 'Natural material for construction.'],
            ['name' => 'Concrete', 'description' => 'Widely used building material.'],
            ['name' => 'Aluminum', 'description' => 'Lightweight and durable metal.'],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }

        $this->command->info('Materials seeded successfully.');
    }
}
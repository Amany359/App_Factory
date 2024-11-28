<?php

use Illuminate\Database\Seeder;
use App\Models\Shape;
use App\Models\Material; // للتأكد من أن المواد موجودة مسبقًا

class ShapeSeeder extends Seeder
{
    public function run()
    {
        // التأكد من وجود مواد لاستخدامها في الربط
        $materials = Material::all();

        if ($materials->isEmpty()) {
            $this->command->warn('No materials found. Please seed the materials table first.');
            return;
        }

        // إنشاء أشكال مرتبطة بالمواد
        foreach ($materials as $material) {
            Shape::factory()->count(5)->create([
                'material_id' => $material->id,
                'area' => rand(50, 200) + rand(0, 99) / 100, // مساحة عشوائية
            ]);
        }

        $this->command->info('Shapes seeded successfully.');
    }
}

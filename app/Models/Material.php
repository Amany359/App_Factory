<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
        use HasFactory;
    
        // تحديد الأعمدة التي يمكن تعيينها باستخدام الـ mass assignment
        protected $fillable = [
            'name', 
            'density', 
            'description'
        ];

        public function shapes()
        {
            return $this->hasMany(Shape::class);  // كل مادة يمكن أن تحتوي على العديد من الأشكال
        }
    }
    


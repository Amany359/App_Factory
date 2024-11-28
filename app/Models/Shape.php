<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shape extends Model
{
    use HasFactory;
// (Mass Assignment)
    protected $fillable = [
        'user_id',
        'shape_type',
        'dimensions',
        'material_id',
        'area',
        'volume',
        'weight'
    ];

    // تعريف العلاقة مع موديل Material
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
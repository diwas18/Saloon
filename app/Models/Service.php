<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'duration',
        'price',
        'category_id',
        'addons',
        'appointment_type',
        'expert_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}

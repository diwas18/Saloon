<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'photo1', 'photo2', 'photo3', 'description', 'expert_id', 'completed_at'];

    protected $casts = [
        'completed_at' => 'datetime',
    ];
    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}

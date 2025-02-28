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
        'branch_id',
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


    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_service', 'service_id', 'branch_id');
    }


public function branch()
{
    return $this->belongsTo(Branch::class); // Ensure this relation exists
}
protected static function booted()
{
    static::deleted(function ($service) {
        // Detach the service from all branches when it's deleted
        $service->branches()->detach();
    });
}



}

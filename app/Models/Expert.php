<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'experience_years',
        'availability',
        'rating',
        'contact_info',
        'languages_spoken',
        'certifications',
        'social_media_link',
        'profile_picture'
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
    //expert
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
    //


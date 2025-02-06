<?php

namespace App\Models;
use App\Models\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'contact_number',
        'location',
        'description',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

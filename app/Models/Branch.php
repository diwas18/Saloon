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
    public function services()
{
    return $this->belongsToMany(Service::class, 'branch_service', 'branch_id', 'service_id');
}

    public function service()
    {
        return $this->belongsTo(Service::class); // Ensure this relation exists
    }





}

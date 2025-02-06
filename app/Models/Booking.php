<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'branch_id', 'expert_id', 'booking_date', 'booking_time', 'status'];


    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Branch model
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Define the relationship with the Expert model (assuming you have an Expert model)
    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}

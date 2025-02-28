<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchService extends Model
{
    protected $table = 'branch_service'; // Define table name explicitly
    protected $fillable = ['branch_id', 'service_id'];

}

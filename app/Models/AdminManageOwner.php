<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminManageOwner extends Model
{
    protected $table = 'admin_manage_owners';
    protected $fillable = [
        'administrators_id', 'owners_id'
    ];
    use HasFactory;
}

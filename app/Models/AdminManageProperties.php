<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminManageProperties extends Model
{
    protected $table = 'admin_manage_properties';
    protected $fillable = [
        'properties_id','administrators_id'
    ];
    use HasFactory;

}

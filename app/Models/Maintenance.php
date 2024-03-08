<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenances';
    protected $fillable = [
        'property_id',
        'security_deposit'
    ];

    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}

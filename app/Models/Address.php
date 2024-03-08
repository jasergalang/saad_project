<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'property_id',
        'unit_number',
        'floor',
        'street',
        'city',
    ];
    use HasFactory;
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}

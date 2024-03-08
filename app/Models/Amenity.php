<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $table = 'amenities';
    protected $fillable = [
        'property_id',
        'pool',
        'gym',
        'parking',
        'security',
        'balcony',
        'pets_allowed',
    ];
    use HasFactory;
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}

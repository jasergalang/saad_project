<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'details';
    protected $fillable = [
        'property_id',
        'floor_area',
        'furnishing',
        'bedrooms',
        'bathrooms',
        // Add other attributes as needed...
    ];
    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

}

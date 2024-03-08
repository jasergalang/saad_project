<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'property_id',
        'image_path',
    ];

    use HasFactory;

    public function properties()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}

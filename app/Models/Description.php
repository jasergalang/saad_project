<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $primaryKey = 'property_id';
    protected $table = 'descriptions';
    protected $fillable = [
        'property_id',
        'title',
        'description',

    ];
    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}

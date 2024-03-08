<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $primaryKey = 'property_id';
    protected $table = 'rates';
    protected $fillable = [
        'property_id',
        'weekly_rate',
        'monthly_rate',
        'daily_rate',
    ];
    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}

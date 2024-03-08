<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'properties';

    protected $fillable = [
        'owners_id',
        'property_type',
        'long_term',
        'short_term',
        'minimum_stay',
        'verification_status',
    ];
    use HasFactory;

    public function administrators()
    {
        return $this->belongsToMany(Administrator::class, 'admin_manage_properties', 'properties_id','administrators_id');
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owners_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'property_id');
    }

    public function amenity()
    {
        return $this->hasOne(Amenity::class, 'property_id');
    }
    public function image()
    {
        return $this->hasOne(Image::class, 'property_id');
    }

    public function description()
    {
        return $this->hasOne(Description::class, 'property_id');
    }
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'properties_id');
    }

    public function detail()
    {
        return $this->hasOne(Detail::class, 'property_id');
    }

    public function rate()
    {
        return $this->hasOne(Rate::class, 'property_id');
    }
    public function adminmanageproperty()
    {
        return $this->hasMany(AdminManageProperties::class, 'property_id');
    }
}

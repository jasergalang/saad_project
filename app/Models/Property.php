<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'. 'updated_at', 'created_at'];
    protected $table = 'properties';

    protected $fillable = [
        'owners_id',
        'property_type',
        'file_path',
        'verification_status',
    ];
    use HasFactory;


    public function administrators()
    {
        return $this->belongsToMany(Administrator::class, 'admin_manage_properties', 'property_id','administrator_id');
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
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
        return $this->hasMany(Inquiry::class, 'property_id');
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

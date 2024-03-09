<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Owner extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'owners';

    protected $fillable = ['id', 'account_id', 'verification_status', 'facebook_link', 'file_path'];
    use HasFactory;
    public function properties()
    {
        return $this->hasMany(Property::class, 'owner_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
  // Owner.php model
    public function administrators()
    {
        return $this->belongsToMany(Administrator::class, 'admin_manage_owners', 'owner_id', 'administrator_id');
    }
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'owner_id');
    }


}

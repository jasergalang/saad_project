<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Owner extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'owners';

    protected $fillable = ['id', 'accounts_id', 'verification_status', 'facebook_link'];
    use HasFactory;
    public function properties()
    {
        return $this->hasMany(Property::class, 'owners_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'accounts_id');
    }
  // Owner.php model
    public function administrators()
    {
        return $this->belongsToMany(Administrator::class, 'admin_manage_owners', 'owners_id', 'administrators_id');
    }
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'owners_id');
    }


}

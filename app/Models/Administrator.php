<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'administrators';
    protected $fillable = ['id', 'accounts_id'];
    use HasFactory;

    public function account()
    {
        return $this->belongsTo(Account::class, 'accounts_id');
    }
    public function owners()
    {
        return $this->belongsToMany(Owner::class, 'admin_manage_owners', 'administrators_id', 'owners_id');
    }
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'admin_manage_properties', 'administrators_id', 'properties_id');
    }




}

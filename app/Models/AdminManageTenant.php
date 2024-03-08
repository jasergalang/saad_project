<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminManageTenant extends Model
{
    protected $table = 'admin_manage_tenants';
    protected $fillable = [
        'administrators_id', 'tenats_id'
    ];
    use HasFactory;
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenants_id');
    }
    public function administrator()
    {
        return $this->belongsTo(Administrator::class, 'administrators_id');
    }
}

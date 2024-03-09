<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tenants';
    protected $fillable = ['account_id'];
    use HasFactory;

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'tenant_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    public function adminmanagetenant()
    {
        return $this->hasMany(AdminManagePayment::class, 'tenant_id');
    }
}

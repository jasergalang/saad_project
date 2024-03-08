<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminManagePayment extends Model
{
    protected $table = 'admin_manage_payments';
    protected $fillable = [
        'administrators_id', 'payments_id'
    ];
    use HasFactory;
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payments_id');
    }
    public function administrator()
    {
        return $this->belongsTo(Administrator::class, 'administrators_id');
    }
}

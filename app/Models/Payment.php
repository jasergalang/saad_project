<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'payments';

    protected $fillable = [
        'contract_status',
        'payment_date',
        'payment_status',
        'payment_imaeg',

    ];
    use HasFactory;

    public function adminmanagepayment()
    {
        return $this->hasMany(AdminManageTenant::class, 'payment_id');
    }
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    public function owners()
    {
        return $this->belongsTo(Owner::class);
    }

}

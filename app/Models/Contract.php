<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'contracts';

    protected $fillable = [
        'inquiries_id',
        'contracts_status',
        'payment_method',
        'lease_agreement',
        'start_date',
        'end_date',
    ];

    use HasFactory;

    public function payment()
    {
        return $this->hasMany(Payment::class, 'contracts_id');
    }
    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class, 'inquiries_id');
    }

}

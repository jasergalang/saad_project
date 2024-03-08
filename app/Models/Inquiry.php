<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{

    protected $primaryKey = 'id';

    protected $table = 'inquiries';
    protected $fillable = [
        'owners_id',
        'tenants_id',
        'properties_id',
        'inquiry_status'
    ];

    use HasFactory;
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenants_id');
    }
    public function owners()
    {
        return $this->belongsTo(Owner::class, 'owners_id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'properties_id');
    }
    public function contract()
    {
        return $this->hasOne(Contract::class, 'inquiries_id');
    }
}

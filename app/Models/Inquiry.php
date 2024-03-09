<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{

    protected $primaryKey = 'id';

    protected $table = 'inquiries';
    protected $fillable = [
        'owner_id',
        'tenant_id',
        'properties_id',
        'inquiry_status'
    ];

    use HasFactory;
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    public function owners()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
    public function contract()
    {
        return $this->hasOne(Contract::class, 'inquiry_id');
    }
}

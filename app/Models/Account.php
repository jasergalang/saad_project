<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{

    protected $primaryKey = 'id';
    protected $table = 'accounts';
    protected $fillable = ['fname', 'lname', 'email', 'contact', 'password', 'roles'];
    use HasFactory;

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();

    }
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function owner()
    {
        return $this->hasOne(Owner::class, 'account_id');
    }

    public function tenant()
    {
        return $this->hasOne(Tenant::class, 'account_id');
    }

    public function admninistrator()
    {
        return $this->hasOne(Administrator::class, 'account_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

}

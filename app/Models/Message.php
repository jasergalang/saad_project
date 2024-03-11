<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table ='messages';
    protected $fillable = ['sender_id', 'receiver_id', 'property_id', 'content'];
    use HasFactory;


    public function sender()
    {
        return $this->belongsTo(Account::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Account::class, 'receiver_id');
    }
    public function fromUser()
    {
        return $this->belongsTo(Account::class, 'sender_id');
    }
}

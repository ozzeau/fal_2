<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'sender_id', 'receiver_id'];

    public function sender()
    {
        return $this->belongsTo(Users::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Users::class, 'receiver_id');
    }
}
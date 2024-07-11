<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'caption',
        'user_id',
        'image',
        'location',
        'categorie',
    ];
    public function author()
    {
        return $this->belongsTo(users::class, 'user_id');
    }
}

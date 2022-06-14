<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // use HasFactory;
    protected $fillable = [
        'id', 'user_id', 'post_id', 'comment'
    ];
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    public function reply()
    {
        return $this->hasMany(\App\Models\Reply::class, 'comment_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    // use HasFactory;
    protected $fillable = [
        'id', 'post_id', 'comment_id'
    ];
    public function comment()
    {
        return $this->belongsTo(\App\Models\Comment::class, 'comment_id');
    }
}

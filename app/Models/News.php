<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'content'];
    protected $hidden = ['created_at', 'updated_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['recipe_id', 'user_id'];
    protected $hidden = ['created_at', 'updated_at'];
}

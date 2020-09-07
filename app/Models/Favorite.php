<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'recipe_id'];
    protected $hidden = ['created_at', 'updated_at'];
}

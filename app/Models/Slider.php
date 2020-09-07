<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title', 'image', 'status'];
    protected $hidden = ['created_at', 'updated_at'];

    
}

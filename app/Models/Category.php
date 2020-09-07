<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function recipes()
    {
        return $this->hasMany('App\Models\Recipe', 'category_id', 'id');
    }
}
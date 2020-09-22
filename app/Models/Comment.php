<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'recipe_id', 'content'];
    protected $hidden = ['created_at', 'updated_at', 'user_id', 'recipe_id',];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe', 'recipe_id', 'id');
    }
}

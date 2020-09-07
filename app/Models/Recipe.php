<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['title', 'content', 'image', 'components', 'category_id'];
    protected $hidden = ['created_at', 'updated_at', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'recipe_id', 'id');
    }

    // Mutator

    public function setComponentsAttribute($components = null)
    {
        if (isset($components) && $components != "components") {
            $str_components = '';
            foreach ($components as $component) {
                $str_components .= $component . ', ';
            }
            $this->attributes['components'] = $str_components;
        } else {
            $this->attributes['components'] = $components;
        }
    }
}

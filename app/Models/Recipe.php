<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['title', 'content', 'image', 'components', 'category_id'];
    protected $hidden = ['created_at', 'updated_at', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'recipe_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // Mutator

    // public function setComponentsAttribute($components = null)
    // {
    //     if (isset($components) && $components != "components") {
    //         $str_components = '';
    //         foreach ($components as $component) {
    //             $str_components .= $component . ', ';
    //         }
    //         $this->attributes['components'] = $str_components;
    //     } else {
    //         $this->attributes['components'] = $components;
    //     }
    // }

    public function setImageAttribute($image)
    {
        $file_extension = $image->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'images/recipes';
        $image->move($path, $file_name);

        $this->attributes['image'] = $file_name;
    }
}

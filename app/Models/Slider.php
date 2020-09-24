<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'status'];
    protected $hidden = ['created_at', 'updated_at'];

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $file_extension = $image->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = public_path('images/sliders');
            $image->move($path, $file_name);
            $this->attributes['image'] = $file_name;
        } else {
            $this->attributes['image'] = $image;
        }
    }

}

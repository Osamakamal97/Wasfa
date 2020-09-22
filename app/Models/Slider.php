<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title', 'image', 'status'];
    protected $hidden = ['created_at', 'updated_at'];

    public function setImageAttribute($image)
    {
        $file_extension = $image->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = 'images/recipes';
        $image->move($path, $file_name);

        $this->attributes['image'] = $file_name;
    }

    public function setStatusAttribute($status)
    {
        if ($status == null)
            $this->attribute['status'] = 0;
    }
}

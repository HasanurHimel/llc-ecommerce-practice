<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];

    public function parent_category(){

        return $this->belongsTo(Category::class);
    }
    public function child_category(){

        return $this->hasMany(Category::class);
    }
    public function product(){

        return $this->hasMany(Product::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating( function($categories){
            $categories->slug =str_slug($categories->name);
        });
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $guarded=[];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public static function boot()
    {
        parent::boot();
        static ::creating( function ($products){
            $products->slug =str_slug($products->title);
        });
    }
}

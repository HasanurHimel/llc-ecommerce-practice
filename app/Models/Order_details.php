<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    protected $guarded=[];

    public $timestamps=false;

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function products(){
        return $this->belongsTo(Product::class);
    }

}

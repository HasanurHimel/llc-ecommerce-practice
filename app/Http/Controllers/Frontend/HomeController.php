<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $data=[];
        $data['products']=Product::with('media')->select(['id', 'slug', 'title', 'price', 'sale_price', ])->where('active', 1)->paginate(12);

        return view('Frontend.home', $data);
    }

}

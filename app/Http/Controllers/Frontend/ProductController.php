<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function detail($slug){



        $data=[];

       $data['product']=Product::where('slug', $slug)->where('active', 1)->first();


        return view('Frontend.Products.details', $data);


    }

}

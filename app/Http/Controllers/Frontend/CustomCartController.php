<?php
//
//namespace App\Http\Controllers\Frontend;
//
//use App\Models\Product;
//use Dotenv\Exception\ValidationException;
//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
//;
//
//class CartController extends Controller
//{
//    public function show(){
//
//
//        $data=[];
//
//        $data['cart']=session()->has('cart') ? session()->get('cart') : [] ;
//
//        return view('Frontend.Cart.show', $data);
//    }
//    public function add(Request $request){
//
//        $product=Product::findOrFail($request->input('product_id'));
//
//        $cart=[];
//
//
//        if (session()->has('cart')){
//
//            $cart=session()->get('cart');
//            if (array_key_exists($product->id, $cart['products'])){
//
//                $cart['products'][$product->id]['quantity'] +=1;
//            }
//            else{
//                $cart['products'][$product->id]=[
//                    'title'=>$product->title,
//                    'photo'=>$product->getFirstMediaUrl('products'),
//                    'quantity'=>1,
//                    'price'=>($product->sale_price!==null && $product->sale_price>0) ? $product->sale_price : $product->price,
//                ];
//            }
//
//        } else{
//            $cart['products'][$product->id]=[
//                'title'=>$product->title,
//                'photo'=>$product->getFirstMediaUrl('products'),
//                'quantity'=>1,
//                'price'=>($product->sale_price!==null && $product->sale_price>0) ? $product->sale_price : $product->price,
//            ];
//        }
//
//
////        session()->forget('cart');
//        session([ 'cart'=> $cart ]);
//
//
//        return redirect()->route('cart.show');
//
//
//
//
//    }
//}

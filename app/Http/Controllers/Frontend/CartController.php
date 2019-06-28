<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Cart;
use Session;


class CartController extends Controller
{
    public function show(){

        $data=[];
        $data['count']=Cart::content()->count();
        $data['products']=Cart::content();


        return view('Frontend.cart.show', $data);

    }
    public function add(Request $request){

//        session()->forget('cart');

        $product=Product::findOrFail($request->input('product_id'));

        $cart=Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'qty' => 1,
            'price' => ($product->sale_price !==null && $product->sale_price>0) ? $product->sale_price : $product->price ,
            'options' => [
                'image' => $product->getFirstMediaUrl('products')
            ]
        ]);



        return $this->show();


    }

    /**
     * @param Request $request
     */
    public function qty_update(Request $request){

     Cart::update($request->id, $request->qty);
        return $this->show();

}
    public function delete(Request $request){
        $rowId=$request->rowId;

        Cart::remove($rowId);
        session()->flash('message', 'Product deleted successfully');
        return $this->show();
    }
    public function cart_destroy(){
        Cart::destroy();
        $this->setSuccess('your cart has been destroyed..!!');

        return redirect()->route('cart.show');
}


    public function checkout_show(){

        $data=[];
        $data['total']=Cart::subtotal();
        $data['count']=Cart::content()->count();
        $data['products']=Cart::content();
        return view('Frontend.checkout.checkout_show', $data);


    }

    public function order(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'customer_name' => $request->customer_name,
            'customer_phone_number' => $request->customer_phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'total_amount' => Cart::subtotal(),
            'paid_amount' => Cart::subtotal(),
            'payment_details' => 'Cash on delivery',

        ]);


        foreach (Cart::content() as $product) {

            $order->products()->create([
                'product_id' => $product->id,
                'quantity' => $product->qty,
                'price' => $product->price,
            ]);

        }
        Session::forget('total');
        Cart::destroy();
        $this->setSuccess('Thanks for your order');
        return Redirect()->route('frontend.home');


    }





}


@extends('frontend.layout.master')


@section('content')




       <div class="content">
           <div class="cart-items">
               <div class="container">
                   <h1 align="center">My Shopping Bag</h1>
                   @if(session()->has('message'))
                       <h4 class="text-success text-center">
                           {{ session('message') }}
                       </h4>

                   @endif


                   <br/>

                   @if($count)
                       <div class="cart-header">

                           <h2 class="text-danger" align="center"></h2>
                           <table class="table table-bordered ">
                               <thead>
                               <tr class="bg-secondary">
                                   <th>Sl: </th>
                                   <th>Name</th>
                                   <th>Image</th>
                                   <th>Price(Tk. )</th>
                                   <th>Quantity</th>
                                   <th>Total(Tk. )</th>
                                   <th>Action</th>
                               </tr>
                               </thead>

                               <tbody>


                               <?php $sum=0; ?>
                               @php($i=1)
                               @foreach($products as $product)





                                   <tr>

                                       <td>{{ $i++ }}</td>
                                       <td>{{ $product->name }}</td>
                                       <td><img src="{{ $product->options['image'] }}" alt="{{ $product->name }}" height="80px" width="80px"></td>
                                       <td>{{ $product->price }}</td>
                                       <td>
                                           <form action="{{ route('qty.update') }}" method="post">
                                               @csrf
                                               <input type="number" min="1" name="qty" value="{{ $product->qty }}">
                                               <input type="hidden" name="id" value="{{ $product->rowId }}">
                                               <input type="submit"  value="Submit" >
                                           </form>
                                       </td>
                                       <td><?php echo $subtotal=$product->price*$product->qty; ?></td>
                                       <td>
                                           <form action="{{ route('cart.delete') }}" method="post">
                                               @csrf
                                               <input type="hidden" name="rowId" value="{{ $product->rowId }}">
                                               <button type="submit" class="btn btn-danger btn-outline-warning">Delete</button>
                                           </form>


                                       </td>

                                   </tr>


                                   <?php $grandTotal=$sum+=$subtotal ?>

                               @endforeach

                               </tbody>




                           </table>

                           <table class="table table-bordered ">

                               <tr >
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td>Delivery charge  ( TK. )</td>
                                   <td><?php echo $delivery=90; ?> .Tk</td>
                               </tr>
                               <tr >
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td>Total price  ( TK. )</td>
                                   <td><?php echo $total=$grandTotal+$delivery; ?> .Tk</td>
                                   <?php Session::put('total', $total) ?>
                               </tr>


                           </table>





                           <a href="{{ route('frontend.home') }}" class="btn btn-danger">Continue shopping</a>
                           <a href="{{ route('cart.checkout') }}" class="btn btn-success pull-right">Checkout <span class="glyphicon glyphicon-arrow-right"></span></a>
                           <a href="{{ route('cart.destroy') }}" class="btn btn-secondary pull-right">Cart-Destroy<span class="glyphicon glyphicon-arrow-right"></span></a>

                       </div>
                   @else
                       <div class="text-danger">
                           <h3 class="text-center">Your shopping cart has been empty , Please Shop <a href="{{ route('frontend.home') }}"><span class="text-success">here</span></a></h3>
                       </div>
                   @endif


               </div>
           </div>
           <!-- checkout -->
       </div>

{{--    @else--}}
{{--       <div class="alert alert-danger">--}}
{{--           Your cart is empty ..!! please ad to cart your product for buying....--}}
{{--       </div>--}}
{{--    @endif--}}
@endsection

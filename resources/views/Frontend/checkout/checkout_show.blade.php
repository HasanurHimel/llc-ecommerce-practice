@extends('frontend.layout.master')


@section('content')
<br>

    @guest()

        <div class="col-sm-8 alert alert-success">
            <h4>Please login first to processing your order, <a href="{{ route('login') }}">Login here</a></h4>
        </div>
    @else

        <div class="col-sm-8 m-auto">
            <div class="alert alert-success m-auto">
                you are ordering as {{ auth()->user()->name }}
            </div>
            <br>

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">{{ $count }}</span>
                    </h4>


                    <ul class="list-group mb-3">
                        @foreach($products as $product)

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Product name</h6>
                                    <small class="text-muted">{{ $product->name }} ({{ $product->qty }})</small>
                                </div>
                                <span class="text-muted">{{ $product->price*$product->qty }} .Tk</span>
                            </li>
                            @endforeach

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (.Tk)</span>
                            <strong>{{ $total }}</strong>
                        </li>
                    </ul>



                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">Redeem</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>

                    @include('Frontend.Errors.errors')

                    <form action="{{ route('order') }}" method="post" class="needs-validation" novalidate>
                       @csrf

                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <label for="firstName">Customer name</label>
                                <input type="text" class="form-control" name="customer_name" placeholder="" value="{{ auth()->user()->name }}" required>
                            </div>
                        </div>



                        <div class="mb-3">
                            <label for="phone">Phone Number <span class="text-muted"></span></label>
                            <input type="number" name="customer_phone_number" class="form-control" value="{{ auth()->user()->phone_number }}" placeholder="phone number">
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                           <textarea name="address" class="form-control" placeholder="Road no , Post office , Thana , District , Division" required></textarea>
                        </div>


                        <div class="row">


                            {{--<div class="col-md-4 mb-3">--}}
                                {{--<label for="state">City</label>--}}
                                {{--<select name="city" class="custom-select d-block w-100" required>--}}
                                    {{--<option value="">Choose...</option>--}}
                                    {{--<option value="rangpur">Rangpur</option>--}}
                                    {{--<option value="dhaka">Dhaka</option>--}}
                                    {{--<option value="chittagang">Chittagang</option>--}}
                                    {{--<option value="foridpur">Faridpur</option>--}}
                                    {{--<option value="rajshahi">Rajshahi</option>--}}
                                    {{--<option value="kulna">Kulna</option>--}}
                                    {{--<option value="jessore">Jessore</option>--}}
                                    {{--<option value="cumilla">Cumilla</option>--}}
                                    {{--<option value="kurigram">Kurigram</option>--}}
                                {{--</select>--}}

                            {{--</div>--}}
                            <div class="col-md-6 mb-6">
                                <label for="zip">City</label>
                                <input name="city" type="text" class="form-control"  placeholder="city" required>

                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="zip">Postal code</label>
                                <input name="postal_code" type="text" class="form-control"  placeholder="" required>

                            </div>
                        </div>



                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </div>

    @endguest()




@endsection
@extends('Frontend.layout.master')

@section('content')
   @include('Frontend.partials.jumbotron')

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach($products as $product)



                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        {{--have to run  "php artisan storage:link" for shortcut storage folder--}}
                       <a href="{{ route('product.show', $product->slug) }}"> <img class="card-img-top" src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->title }}"></a>
                        <div class="card-body">
                            <p class="card-text"><a href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                               <form action="{{ route('cart.add') }}" method="post">
                                   @csrf
                                   <input type="hidden" name="product_id" value="{{ $product->id }}">
                                   <button type="submit" class="btn btn-block btn-outline-success">Add to cart</button>

                               </form>

                                </div>
                                <div class="currency">
                                    @if($product->sale_price && $product->sale_price>0)
                                        BDT. <strike>{{ $product->price }}</strike> <br> <strong> BDT. </strong> {{ $product->sale_price }}
                                    @else
                                        <strong>BDT. </strong> {{ $product->price }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


           @endforeach


            </div>
            {{ $products->links() }}
        </div>

    </div>

    @endsection
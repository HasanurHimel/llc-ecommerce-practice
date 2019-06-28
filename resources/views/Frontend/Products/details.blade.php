@extends('Frontend.layout.master')

@section('content')


    <div class="container">
        <br>
        <p class="text-center">{{ $product->title }}</p>
        <hr>
        <div class="card">
            <div class="row">
                <aside class="col-sm-5 border-right">
                    <article class="gallery-wrap">
                        <div>
                            <img class="card-img-top" src="{{ $product->getFirstMediaUrl('products') }}" alt="{{ $product->title  }}">
                        </div>
                    </article>
                </aside>
                <aside class="col-sm-7">
                    <article class="card-body p-5">
                        <h3 class="title mb-3">{{ $product->title }}</h3>
                        <p class="price-detail-wrap">
                            <span class="price h3 text-warning"></span>
                            {{--<span class="currency"><strong>BDT. </strong></span>--}}
                            <span class="num">
                                @if($product->sale_price && $product->sale_price>0)
                                    BDT. <strike>{{ $product->price }}</strike><br>  <strong> BDT. </strong> {{ $product->sale_price }}
                                    @else
                                    <strong>BDT. </strong> {{ $product->price }}
                                    @endif

                            </span>
                        </p>
                        <d1 class="item-property">
                            <dt>Description</dt>
                            <dd><p>{{ $product->description }}</p></dd>

                        </d1>
                        <hr>
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-lg btn-outline-primary text-uppercase" >Add to cart</button>
                        </form>




                    </article>
                </aside>
            </div>
        </div>
    </div>



@endsection
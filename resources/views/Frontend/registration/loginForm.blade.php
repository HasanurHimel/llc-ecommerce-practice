@extends('frontend.layout.master')
@section('content')

    <div class="content">
        <div class="cart-items">
            <div class="container">
                <div class="col-md-12 well">
                    <h3 align="center" class="alert alert-success text-success">Login form , if you already registered</h3>
                </div>

                <div class="col-md-9 col-sm-offset-2 well">

                    @include('Frontend.Errors.errors')

                    <form action="{{ route('login') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <input type="email" name="email" {{ old('email') }} class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" {{ old('password') }} class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" name="btn" class="" value="Register">
                        </div>

                    </form>
                </div>

            </div>
        </div>
        <!-- checkout -->
    </div>
@endsection

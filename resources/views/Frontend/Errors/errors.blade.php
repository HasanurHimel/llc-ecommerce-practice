

@if($errors->any())
    <div class="alert alert-danger">
        @if(count($errors) >1)
            @foreach($errors->all() as $error)
                <ul>
                    <li>{{ $error }}</li>
                </ul>
            @endforeach
        @else
            {{ $errors->first() }}
        @endif

    </div>
@endif

  @if(session()->has('message'))
    <div class="alert alert-{{ session('type') }}">
        {{ session('message') }}
    </div>
    @endif

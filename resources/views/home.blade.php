@extends('masters.app')

@section('content')
    <div class="container">
        <div class="pb-3">
            <h2 class="font-weight-bold">Home</h2>
            <p class="text-muted">Welcome to the home page of the Hail test application.</p>
        </div>

        @if (!auth()->check())
            <div class="alert alert-info">
                <strong>
                    Please login to access your Hail application and data.
                </strong>
            </div>
        @else
            <div class="jumbotron">
                <h1 style="font-weight: bold">{{ $organisation->name }}</h1>
                <p class="lead">{{ $organisation->id }}</p>
            </div>

            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach ($images as $image)
                            <li class="glide__slide">
                                <img src="{{ $image->file_500_url }}">
                                <p class="lead text-muted">
                                    {{ $image->caption }}
                                </p>
                                <p class="text-muted">
                                    {{ $image->created_date }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div data-glide-el="controls">
                    <button class="btn btn-primary" data-glide-dir="<<">First</button>
                    <button class="btn btn-primary" data-glide-dir=">>">Last</button>
                </div>
            </div>
        @endif
    </div>
@endsection
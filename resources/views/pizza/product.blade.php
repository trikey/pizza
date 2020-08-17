@extends('layouts.pizza')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div>
                    <ul>
                        <li><a href="{{ route('index') }}">Main</a></li>
                        <li>
                            <a href="{{ route('categories.show', ['category' => $product->category]) }}">
                                {{ $product->category->name }}
                            </a>
                        </li>
                        <li>{{ $product->name }}</li>
                    </ul>
                </div>

                <h1>{{ $product->name }}</h1>
                <div class="slider">
                    @foreach($product->images as $image)
                        <img src="{{ $image->url }}"/>
                    @endforeach
                </div>
                <p>{{ $product->description }}</p>
                <p class="price-tag"><b>${{ $product->price }}</b></p>
                <a href="#" data-product="{{ $product->slug }}" class="add-to-cart order-btn">Add to Cart</a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
      $('.slider').bxSlider({ auto: true });
    });
    </script>
@endsection

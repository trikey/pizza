@extends('layouts.pizza')

@section('content')
    <div class="container">
        <ul class="breadcrumbs flex-grid">
            <li>
                <a href="{{ route('index') }}">Main</a>
                <span class="separator">/</span>
            </li>

            <li>
                <a href="{{ route('categories.show', ['category' => $product->category]) }}">
                    {{ $product->category->name }}</a>
                <span class="separator">/</span>
            </li>

            <li>{{ $product->name }}</li>
        </ul>
        <div class="row">
            <div class="col-lg-6">
                <div class="slider">
                    @foreach($product->images as $image)
                        <img src="{{ $image->url }}"/>
                    @endforeach
                </div>
            </div>
            <div class="product-info col-lg-6">
                <h1>{{ $product->name }}</h1>

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

@extends('layouts.pizza')

@section('content')
    <div>
        <div class="container">
            <h1>{{ $sectionName }}</h1>
            @foreach($products as $row => $productsInRow)
                <div class="row">
                    @foreach($productsInRow as $index => $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="menu-item">
                                <a href="{{ route('products.show', ['product' => $product]) }}">
                                    <div class="menu-item-bg"
                                         style="background-image: url({{ $product->images[0]->url }})"></div>
                                </a>
                                <h6>{{ $product->name }}</h6>
                                <div class="text">
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div class="flex-grid">
                                    <p class="price-tag">{{ $product->formatted_price }}</p>
                                    <a href="#"  data-product="{{ $product->slug }}" class="add-to-cart order-btn">
                                        Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

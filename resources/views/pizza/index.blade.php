@extends('layouts.pizza')

@section('content')
    <div id="menu" class="menu-area section-padding">
        <div class="container">
            @foreach($products as $row => $productsInRow)
                <div class="row">
                    @foreach($productsInRow as $index => $product)
                        <div class="col-lg-4 col-md-4">
                            <div class="single-menu-item">
                                <a href="{{ route('products.show', ['product' => $product]) }}">
                                    <div class="menu-item-bg"
                                         style="background-image: url({{ $product->images[0]->url }})"></div>
                                </a>
                                <h6>{{ $product->name }}</h6>
                                <p>{{ $product->description }}</p>
                                <p class="price-tag"><b>${{ $product->price }}</b></p>
                                <a href="#"  data-product="{{ $product->slug }}" class="add-to-cart order-btn">
                                    Add to Cart</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

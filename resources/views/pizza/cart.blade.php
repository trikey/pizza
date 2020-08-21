@extends('layouts.pizza')

@section('content')
    <div class="container">
        @foreach($cartItems as $cartItem)
            <div class="row item">
                <div class="col-lg-6 col-7">
                    <div class="row">
                        <div class="item-img col-lg-4 col-3"><img src="{{ $cartItem->product->images[0]->url }}"></div>
                        <div class="item-name col-lg-8 col-9">{{ $cartItem->product->name }}</div>
                    </div>
                </div>
                <div class="col-lg-6 col-5">
                    <div class="flex-grid">
                        <div class="item-quantity flex-grid">
                            <div class="cart-minus flex-grid" data-cart-item-id="{{ $cartItem->id }}"><span>-</span></div>
                            <div class="number">{{ $cartItem->quantity }}</div>
                            <div class="cart-plus flex-grid" data-cart-item-id="{{ $cartItem->id }}"><span>+</span></div>
                        </div>
                        <div class="item-total-price">{{ $cartItem->sum }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

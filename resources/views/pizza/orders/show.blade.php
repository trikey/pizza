@extends('layouts.pizza')

@section('content')
    <div class="container details-wrapper">
        <h1>Order details</h1>
        <h6>Order: #{{ $order->id }}</h6>
        <div>Date: {{ $order->created_at }}</div>
        @foreach($order->cartItems as $cartItem)
            <div class="row item">
                <div class="col-lg-6 col-8">
                    <div class="row">
                        <div class="item-img col-lg-3 col-3">
                            <img src="{{ $cartItem->product->images[0]->url }}">
                        </div>
                        <div class="item-name col-lg-9 col-9">{{ $cartItem->product->name }}</div>
                    </div>
                </div>
                <div class="col-lg-6 col-4">
                    <div class="flex-grid">
                        <div class="item-quantity flex-grid">
                            {{ $cartItem->quantity }}
                        </div>
                        <div class="item-total-price">{{ $cartItem->sum }}</div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row total">
            <div class="col-6"></div>
            <div class="col-6">
                <div>Products price: {{ $order->products_price }}</div>
                <div>Delivery price: {{ $order->delivery_price }}</div>
                <h6>Total: {{ $order->total }}</h6>
            </div>
        </div>
    </div>
@endsection

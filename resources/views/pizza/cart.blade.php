@extends('layouts.pizza')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col" id="cart-container">
                @foreach($cartItems as $cartItem)
                    <div class="cart-item">
                        <p>{{ $cartItem->product->name }}</p>
                        <p>{{ $cartItem->quantity }} * {{ $cartItem->price }} = {{ $cartItem->sum }}</p>
                        <p>
                            <span class="cart-minus" data-cart-item-id="{{ $cartItem->id }}">-</span>
                        </p>
                        <p>
                            <span class="cart-plus" data-cart-item-id="{{ $cartItem->id }}">+</span>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

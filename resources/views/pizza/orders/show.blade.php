@extends('layouts.pizza')

@section('content')
    <div class="container">
        <h1>Order details</h1>
        <div class="row">
            <div class="col">
                <div>order: #{{ $order->id }}</div>
                <div>date: {{ $order->created_at }}</div>
                <div>total: {{ $order->total }}</div>
                <div>delivery price: {{ $order->delivery_price }}</div>
                <div>products price: {{ $order->products_price }}</div>
            </div>
        </div>
        <h2>Order list</h2>
        @foreach($order->cartItems as $cartItem)
            <div class="row">
                <div class="col-lg-3">
                    {{ $cartItem->product->name }}
                    <img src="{{ $cartItem->product->images[0]->url }}">
                </div>
                <div class="col-lg-3">{{ $cartItem->quantity }}</div>
                <div class="col-lg-3">{{ $cartItem->price }}</div>
                <div class="col-lg-3">{{ $cartItem->sum }}</div>
            </div>
        @endforeach
    </div>
@endsection

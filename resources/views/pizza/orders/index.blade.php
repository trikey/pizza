@extends('layouts.pizza')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">#</div>
            <div class="col-lg-4">date</div>
            <div class="col-lg-4">total</div>
        </div>
        @foreach($orders as $order)
            <div class="row">
                <div class="col-lg-4">order <a href="{{ route('orders.show', ['order' => $order]) }}">#{{ $order->id }}</a></div>
                <div class="col-lg-4">{{ $order->created_at }}</div>
                <div class="col-lg-4">{{ $order->total }}</div>
            </div>
        @endforeach
    </div>
@endsection

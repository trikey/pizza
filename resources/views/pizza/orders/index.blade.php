@extends('layouts.pizza')

@section('content')
    <div class="container order-wrapper">
        <h1>Order history</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>order <a href="{{ route('orders.show', ['order' => $order]) }}">#{{ $order->id }}</a></td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->total }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

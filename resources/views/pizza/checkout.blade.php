@extends('layouts.pizza')

@section('content')
    <div class="container">
        <h1>Checkout</h1>
        <form method="post" id="checkout-form">
            @foreach($properties as $property)
                <div class="form-group">
                    <label for="{{ $property->code }}">{{ $property->name }}</label>
                    <input type="{{ $property->type }}" name="{{ $property->code }}" class="form-control"
                           id="{{ $property->code }}"
                           placeholder="Enter {{ $property->name }}" data-msg="Enter {{ $property->name }}"
                           @if($property->required)data-rule-required="true"
                           @endif @if($property->is_email)data-rule-email="true"@endif />
                </div>
            @endforeach
            <div class="text-danger" id="error-msg"></div>
        </form>
    </div>
@endsection

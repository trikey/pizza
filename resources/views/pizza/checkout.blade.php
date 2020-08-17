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
            <input type="submit" class="btn btn-primary" value="Submit"/>
        </form>
    </div>
    <script type="text/javascript">
    $.validator.addMethod('notEmpty', function (value, element) {
      return value === '' || value.trim().length !== 0;
    });

    $.validator.addMethod('checkMask', function (value, element) {
      return /\+\d{1} \(\d{3}\) \d{3}-\d{2}-\d{2}/g.test(value);
    });

    $('#phone').mask('+7 (999) 999-99-99', { autoclear: false });

    $('#checkout-form').validate({
      onsubmit: true,
      errorClass: 'is-invalid',
      validClass: 'is-valid',
      rules: {
          @foreach($properties as $property)
          '{{$property->code}}': {
              @if ($property->required)
              notEmpty: true,
              @endif
              @if ($property->is_phone)
              checkMask: true,
              @endif
          },
          @endforeach
      },
      submitHandler: function (form) {
        var data = $(form).serialize();
        var error = $('#error-msg');
        error.hide();
        $.ajax({
          url: '/ajax/checkout',
          data: data,
          type: 'POST',
          dataType: 'json',
        }).done(function (data) {
          $(form).replaceWith(data.message);
          $('#cart-count').text(0);
        }).catch(function (data, message) {
          error.text(message).show();
        });
        return false;
      }
    });
    </script>
@endsection

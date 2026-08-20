@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h1>Redirecting to secure payment</h1>
    <p>Please wait while we connect you to the payment gateway.</p>
    <form id="payuGatewayForm" method="POST" action="{{ $paymentDetails['actionUrl'] }}">
        @foreach($paymentDetails as $name => $value)
            @if($name !== 'actionUrl')
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endif
        @endforeach
        <noscript><button type="submit" class="btn btn-primary">Continue to Payment</button></noscript>
    </form>
</div>
<script>
    document.getElementById('payuGatewayForm').submit();
</script>
@endsection

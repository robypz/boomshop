@extends('layouts.mobilePaymentBDV')
@section('content')
    <form action="{{route('order.store')}}" method="POST" id="form">
        @csrf
        <input type="text" name="bundle_id" hidden value="{{ $request->bundle_id }}">
        <input type="text" name="payment_method_id" hidden value="{{ $request->payment_method_id }}">
        @if ($bundle->product->need_region_id)
            <input type="text" name="account_id" hidden value="{{ $request->account_id }}">
            <input type="text" name="region_id" hidden value="{{ $request->region_id }}">
        @elseif ($bundle->product->need_access)
            <input type="tel" name="phone" hidden value="{{ $request->phone }}">
        @else
            <input type="text" name="account_id" hidden value="{{ $request->account_id }}">
        @endif
        <input type="number" name="amount" step="0.01" class="form-control mb-4" id="form-amount"
            value="{{ $request->amount}}" hidden>
        <input type="text" hidden name="transactionId" id="transactionId">
        <input type="text" hidden name="description" id="description">
    </form>
    <script src="https://puntoyapos.com.ve/pos/assets/scripts/py-script.js"></script>

    <script>
        const amount = document.getElementById('form-amount').value;
        const callback = (response) => {
            if (response.ok) {
                console.log(response);
                document.getElementById('transactionId').value = response.transactionId;
                document.getElementById('description').value = response.description;
                document.getElementById('form').submit();
            }
        };
        payWithPuntoYa(amount, callback);
    </script>
@endsection

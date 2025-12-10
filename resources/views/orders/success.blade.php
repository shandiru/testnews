@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow p-6 rounded">

    <h1 class="text-3xl font-bold text-green-600">Payment Successful!</h1>

    <p class="mt-2 text-lg">Thank you, {{ $order->name }}.</p>

    <h2 class="text-xl font-bold mt-4">Order Summary</h2>

    <p><strong>Email:</strong> {{ $order->email }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>

    <h3 class="text-lg font-bold mt-3">Items</h3>
    @php $items = json_decode($order->items, true); @endphp

    <ul class="list-disc ml-6">
        @foreach($items as $item)
            <li>{{ $item['title'] }} × {{ $item['quantity'] }} — ${{ $item['price'] }}</li>
        @endforeach
    </ul>

    <p class="mt-4 text-xl font-bold">Total: ${{ $order->total_amount }}</p>

</div>
@endsection

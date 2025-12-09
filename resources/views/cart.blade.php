@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Your Cart</h1>

    @if(count($cart) > 0)
        <table class="w-full text-left border">
            <thead>
                <tr class="border-b">
                    <th class="p-2">Title</th>
                    <th class="p-2">Type</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Quantity</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr class="border-b" id="cart-item-{{ $item['type'] }}-{{ $item['id'] }}">
                        <td class="p-2">{{ $item['title'] }}</td>
                        <td class="p-2">{{ ucfirst($item['type']) }}</td>
                        <td class="p-2">${{ number_format($item['price']) }}</td>
                        <td class="p-2" id="quantity-{{ $item['type'] }}-{{ $item['id'] }}">{{ $item['quantity'] }}</td>
                        <td class="p-2">
                            <button onclick="updateQuantity({{ $item['id'] }}, '{{ $item['type'] }}', 'increment')" class="bg-green-500 text-white px-2 py-1 rounded">+</button>
                            <button onclick="updateQuantity({{ $item['id'] }}, '{{ $item['type'] }}', 'decrement')" class="bg-red-500 text-white px-2 py-1 rounded">−</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection

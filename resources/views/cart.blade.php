@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-6">My Cart</h2>

@foreach($cart as $index => $item)
<div id="cartItem-{{ $index }}" 
     class="bg-white border border-gray-200 rounded-lg p-4 flex items-center gap-4 shadow-sm hover:shadow-md transition">

    {{-- IMAGE --}}
    <div class="w-20 h-20 rounded-md overflow-hidden bg-gray-100 border">
        @if($item['image'])
            <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover" />
        @endif
    </div>

    {{-- DETAILS --}}
    <div class="flex-1">
        <h3 class="text-lg font-semibold">{{ $item['title'] }}</h3>
        <p class="text-sm text-gray-500">{{ ucfirst($item['type']) }}</p>

        {{-- QUANTITY --}}
        <div class="flex items-center gap-3 mt-2">
            <button onclick="updateQty({{ $index }}, 'minus')"
                class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded hover:bg-gray-300">–</button>

            <span class="item-qty text-lg font-bold">{{ $item['quantity'] }}</span>

            <button onclick="updateQty({{ $index }}, 'plus')"
                class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded hover:bg-gray-300">+</button>
        </div>
    </div>

    {{-- PRICE --}}
    <div class="text-right">
        <p class="item-total text-xl font-bold text-green-600">
            ${{ number_format($item['price'] * $item['quantity'], 2) }}
        </p>
        <p class="text-xs text-gray-500">${{ number_format($item['price'], 2) }}/each</p>
    </div>

    {{-- REMOVE --}}
    <button onclick="removeFromCart({{ $index }})"
        class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 ml-4">
        Remove
    </button>
</div>
@endforeach

@endsection

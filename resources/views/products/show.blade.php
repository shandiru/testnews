@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

    @if($product->images)
        <img src="{{ asset('storage/' . $product->images[0]) }}" class="w-full h-60 object-cover rounded">
    @endif

    <h1 class="text-3xl font-bold mt-4">{{ $product->title }}</h1>
    <p class="text-gray-700 mt-2">{{ $product->description }}</p>

    <div class="mt-4">
        <p class="text-blue-600 font-bold text-xl">
            ${{ number_format($product->price) }}
        </p>
    </div>

    @php
        $cart = session('cart', []);
        $key = 'product_'.$product->id;
        $inCart = isset($cart[$key]);
    @endphp

    <!-- Add Button -->
    <button id="add-btn"
        onclick="updateCart({{ $product->id }}, 'product', 'add')"
        class="bg-gray-800 text-white px-4 py-2 rounded mt-4 {{ $inCart ? 'hidden' : '' }}">
        Add to Cart
    </button>

    <!-- Remove Button -->
    <button id="remove-btn"
        onclick="updateCart({{ $product->id }}, 'product', 'remove')"
        class="bg-red-600 text-white px-4 py-2 rounded mt-4 {{ $inCart ? '' : 'hidden' }}">
        Remove from Cart
    </button>

</div>


@endsection

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

</div>

@endsection

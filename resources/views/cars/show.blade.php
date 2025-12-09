@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

    @if($car->images)
        <img src="{{ asset('storage/' . $car->images[0]) }}" class="w-full h-60 object-cover rounded">
    @endif

    <h1 class="text-3xl font-bold mt-4">{{ $car->title }}</h1>

    <p class="text-gray-700 mt-2">{{ $car->description }}</p>

    <div class="mt-4">
        <p class="text-lg font-semibold">Brand: {{ $car->brand }}</p>
        <p class="text-lg font-semibold">Model: {{ $car->model }}</p>
        <p class="text-lg font-semibold">Year: {{ $car->year }}</p>
        <p class="text-green-600 font-bold text-xl mt-2">
            ${{ number_format($car->price) }}
        </p>
    </div>

</div>

@endsection

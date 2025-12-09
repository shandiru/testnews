@extends('layouts.app')

@section('content')

{{-- ================= CAR SECTION ================= --}}
<section id="cars">
    <h2 class="text-2xl font-bold mb-4">Cars</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($cars as $car)
            @include('components.car-card', ['car' => $car])
        @endforeach
    </div>
</section>

{{-- ================= PRODUCT SECTION ================= --}}
<section id="products">
    <h2 class="text-2xl font-bold mb-4">Products</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($products as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </div>
</section>

@endsection

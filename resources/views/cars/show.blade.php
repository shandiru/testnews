@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </a>

        <div class="bg-white shadow-xl rounded-3xl overflow-hidden">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                
                <!-- Left Side - Images -->
                <div class="bg-white p-6 lg:p-8">
                    @if($car->images && count($car->images) > 0)
                        <div class="flex gap-4">
                            
                            <!-- Thumbnail Column -->
                            @if(count($car->images) > 1)
                            <div class="w-24 flex-shrink-0 space-y-3 max-h-[600px] overflow-y-auto scrollbar-thin">
                                @foreach($car->images as $index => $image)
                                <button onclick="changeImage('{{ asset('storage/' . $image) }}', {{ $index }})" 
                                        class="w-full aspect-square rounded-lg overflow-hidden border-2 transition-all duration-300 focus:outline-none {{ $index == 0 ? 'border-gray-900 ring-2 ring-gray-900 ring-offset-2' : 'border-gray-200 hover:border-gray-400' }}"
                                        id="thumb-{{ $index }}">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                         class="w-full h-full object-cover"
                                         alt="View {{ $index + 1 }}">
                                </button>
                                @endforeach
                            </div>
                            @endif

                            <!-- Main Image -->
                            <div class="flex-1 relative">
                                <div class="w-full aspect-[4/3] bg-gray-100 rounded-2xl overflow-hidden">
                                    <img id="mainImage" src="{{ asset('storage/' . $car->images[0]) }}" 
                                         class="w-full h-full object-cover"
                                         alt="{{ $car->title }}">
                                </div>
                                
                                <!-- Image Counter Badge -->
                                @if(count($car->images) > 1)
                                <div class="absolute top-4 right-4 bg-gray-900/80 backdrop-blur-sm px-4 py-2 rounded-lg">
                                    <span class="text-white font-medium text-sm" id="imageCounter">1 / {{ count($car->images) }}</span>
                                </div>
                                @endif
                            </div>

                        </div>
                    @endif
                </div>

                <!-- Right Side - Details -->
                <div class="p-8 lg:p-10 flex flex-col bg-gray-50">
                    
                    <!-- Title & Price -->
                    <div class="mb-8">
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">{{ $car->title }}</h1>
                        <div class="inline-block bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-4 rounded-2xl shadow-lg">
                            <span class="text-3xl font-bold text-white">${{ number_format($car->price) }}</span>
                        </div>
                    </div>

                    <!-- Specifications -->
                    <div class="mb-8">
                        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Specifications</h2>
                        <div class="bg-white rounded-2xl p-6 space-y-4 shadow-sm">
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600 font-medium">Brand</span>
                                <span class="text-gray-900 font-bold text-lg">{{ $car->brand }}</span>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <span class="text-gray-600 font-medium">Model</span>
                                <span class="text-gray-900 font-bold text-lg">{{ $car->model }}</span>
                            </div>
                            <div class="flex items-center justify-between py-3">
                                <span class="text-gray-600 font-medium">Year</span>
                                <span class="text-gray-900 font-bold text-lg">{{ $car->year }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-8 flex-grow">
                        <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Description</h2>
                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <div class="prose prose-sm prose-gray max-w-none text-gray-700 leading-relaxed">
                                {!! $car->description !!}
                            </div>
                        </div>
                    </div>

                    <!-- Cart Actions -->
                    @php
                        $cart = session('cart', []);
                        $key = 'car_'.$car->id;
                        $inCart = isset($cart[$key]);
                    @endphp

                    <div class="space-y-3 mt-auto">
                        <button id="add-btn" 
                                onclick="updateCart({{ $car->id }}, 'car', 'add')" 
                                class="w-full bg-gray-900 hover:bg-black text-white font-bold px-8 py-5 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200 {{ $inCart ? 'hidden' : '' }}">
                            <span class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Add to Cart
                            </span>
                        </button>

                        <button id="remove-btn" 
                                onclick="updateCart({{ $car->id }}, 'car', 'remove')" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-5 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200 {{ $inCart ? '' : 'hidden' }}">
                            <span class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Remove from Cart
                            </span>
                        </button>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<script>
function changeImage(imageSrc, index) {
    document.getElementById('mainImage').src = imageSrc;
    document.getElementById('imageCounter').textContent = (index + 1) + ' / {{ count($car->images ?? []) }}';
    
    // Update active thumbnail border
    document.querySelectorAll('[id^="thumb-"]').forEach(thumb => {
        thumb.classList.remove('border-gray-900', 'ring-2', 'ring-gray-900', 'ring-offset-2');
        thumb.classList.add('border-gray-200');
    });
    document.getElementById('thumb-' + index).classList.remove('border-gray-200');
    document.getElementById('thumb-' + index).classList.add('border-gray-900', 'ring-2', 'ring-gray-900', 'ring-offset-2');
}
</script>

<style>
.scrollbar-thin::-webkit-scrollbar {
    width: 6px;
}
.scrollbar-thin::-webkit-scrollbar-track {
    background: #f3f4f6;
}
.scrollbar-thin::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 3px;
}
.scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}
</style>

@endsection
<div class="group bg-white shadow-lg hover:shadow-2xl rounded-2xl overflow-hidden transition-all duration-300 transform hover:-translate-y-1">

    <a href="{{ route('car.show', $car->title) }}" class="block">
        @if($car->images)
            <div class="relative overflow-hidden aspect-[4/3]">
                <img src="{{ asset('storage/' . $car->images[0]) }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                     alt="{{ $car->title }}" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <!-- Price Badge on Image -->
                <div class="absolute bottom-4 right-4 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full shadow-lg">
                    <span class="text-lg font-bold text-green-600">${{ number_format($car->price) }}</span>
                </div>
            </div>
        @endif
    </a>

    <div class="p-5">
        <a href="{{ route('car.show', $car->title) }}" class="block">
            <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-1">
                {{ $car->title }}
            </h2>
        </a>
        
        <p class="text-gray-600 text-sm font-medium mb-3">
            {{ $car->brand }} <span class="text-gray-400">•</span> {{ $car->model }}
        </p>

        <div class="pt-3 border-t border-gray-100">
            <a href="{{ route('car.show', $car->title) }}" 
               class="inline-flex items-center text-sm font-semibold text-gray-900 hover:text-blue-600 transition-colors">
                View Details
                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

</div>
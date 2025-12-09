<div class="bg-white shadow rounded-lg overflow-hidden p-4">

    <a href="{{ route('car.show', $car->title) }}">
        @if($car->images)
            <img src="{{ asset('storage/' . $car->images[0]) }}"
                 class="w-full h-40 object-cover rounded mb-3" />
        @endif
    </a>

    <h2 class="text-lg font-bold">{{ $car->title }}</h2>
    <p class="text-gray-600 text-sm">{{ $car->brand }} - {{ $car->model }}</p>

    <p class="text-green-600 font-semibold mt-2">
        ${{ number_format($car->price) }}
    </p>

</div>

<div class="bg-white shadow rounded-lg overflow-hidden p-4">

    <a href="{{ route('product.show', $product->id) }}">
        @if($product->images)
            <img src="{{ asset('storage/' . $product->images[0]) }}"
                 class="w-full h-40 object-cover rounded mb-3" />
        @endif
    </a>

    <h2 class="text-lg font-bold">{{ $product->title }}</h2>

    <p class="text-blue-600 font-semibold mt-2">
        ${{ number_format($product->price) }}
    </p>

</div>

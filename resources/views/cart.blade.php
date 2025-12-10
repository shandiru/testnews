@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Your Cart</h1>

    @if(count($cart) > 0)
        <table class="w-full text-left border mb-4">
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
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp

                    <tr class="border-b" id="cart-item-{{ $item['type'] }}-{{ $item['id'] }}">
                        <td class="p-2">{{ $item['title'] }}</td>
                        <td class="p-2">{{ ucfirst($item['type']) }}</td>
                        <td class="p-2">${{ number_format($item['price']) }}</td>
                        <td class="p-2" id="quantity-{{ $item['type'] }}-{{ $item['id'] }}">
                            {{ $item['quantity'] }}
                        </td>
                        <td class="p-2">
                            <button onclick="updateQuantity({{ $item['id'] }}, '{{ $item['type'] }}', 'increment')" class="bg-green-500 text-white px-2 py-1 rounded">+</button>
                            <button onclick="updateQuantity({{ $item['id'] }}, '{{ $item['type'] }}', 'decrement')" class="bg-red-500 text-white px-2 py-1 rounded">−</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="text-xl font-semibold mb-4">
            Total Amount: <span class="text-blue-600">${{ $total }}</span>
        </div>

        <button onclick="openOrderForm()" 
            class="bg-blue-600 text-white px-4 py-2 rounded">
            Buy Now
        </button>

    @else
        <p>Your cart is empty.</p>
    @endif
</div>

<!-- Popup Form -->
<div id="orderFormModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-xl font-bold mb-3">Customer Details</h2>

        <form method="POST" action="{{ route('checkout') }}">
            @csrf

            <input type="text" name="name" placeholder="Full Name" class="w-full border p-2 mb-2" required>

            <input type="email" name="email" placeholder="Email" class="w-full border p-2 mb-2" required>

            <textarea name="address" placeholder="Address" class="w-full border p-2 mb-2" required></textarea>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">
                Continue to Payment
            </button>
        </form>

        <button onclick="closeOrderForm()" class="mt-3 text-red-600 w-full">Cancel</button>
    </div>
</div>

<script>
function openOrderForm() {
    document.getElementById('orderFormModal').classList.remove('hidden');
}

function closeOrderForm() {
    document.getElementById('orderFormModal').classList.add('hidden');
}

// Example AJAX quantity update
function updateQuantity(id, type, action) {
    fetch(`/cart/update`, {
        method: "POST",
        headers: {"Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}"},
        body: JSON.stringify({ id, type, action })
    })
    .then(res => res.json())
    .then(() => location.reload());
}
</script>

@endsection

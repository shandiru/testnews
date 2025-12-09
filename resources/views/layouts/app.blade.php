<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'SPA App' }}</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    {{-- HEADER --}}
    @include('partials.header')

    <main class="container mx-auto py-10 px-4 space-y-20">
        @yield('content')
    </main>
<script>
function updateCart(id, type, action) {
    fetch("{{ route('cart.update') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ id: id, type: type, action: action })
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            document.getElementById('cart-count').innerText = data.cart_count;

            // Toggle buttons
            const addBtn = document.getElementById('add-btn');
            const removeBtn = document.getElementById('remove-btn');

            if(action === 'add') {
                addBtn.classList.add('hidden');
                removeBtn.classList.remove('hidden');
            } else if(action === 'remove') {
                removeBtn.classList.add('hidden');
                addBtn.classList.remove('hidden');
            }
        } else {
            alert(data.message);
        }
    })
    .catch(err => console.log(err));
}

function updateQuantity(id, type, action) {
    fetch("{{ route('cart.quantity') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ id: id, type: type, action: action })
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            const key = type + '_' + id;
            const item = data.cart[key];

            const qtyElem = document.getElementById('quantity-' + type + '-' + id);

            if(item) {
                qtyElem.innerText = item.quantity;
            } else {
                // Item removed from cart
                document.getElementById('cart-item-' + type + '-' + id).remove();
            }

            // Update cart count in header
            document.getElementById('cart-count').innerText = data.cart_count;

            if(Object.keys(data.cart).length === 0){
                location.reload(); // Optional: reload page if cart is empty
            }
        }
    })
    .catch(err => console.log(err));
}
</script>

</body>



</html>

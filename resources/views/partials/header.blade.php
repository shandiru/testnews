<header class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-md">
    <div class="container mx-auto flex justify-between items-center px-4 py-4">
        <h1 class="text-2xl font-extrabold">
            My<span class="text-yellow-300">Store</span>
        </h1>

        <div class="relative">
            <a href="{{ route('cart.view') }}" id="cart-link" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m4-9l2 9" />
                </svg>
                <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1">
                    {{ count(session('cart', [])) }}
                </span>
            </a>
        </div>
    </div>
</header>

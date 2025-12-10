<header class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-md">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        <!-- Logo -->
        <h1 class="text-3xl font-extrabold tracking-wide">
            My<span class="text-yellow-300">Store</span>
        </h1>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-6">
            <a href="#" class="hover:text-yellow-300 transition-colors duration-300">Home</a>
            <a href="#" class="hover:text-yellow-300 transition-colors duration-300">Shop</a>
            <a href="#" class="hover:text-yellow-300 transition-colors duration-300">About</a>
            <a href="#" class="hover:text-yellow-300 transition-colors duration-300">Contact</a>
        </nav>

        <!-- Cart & Mobile Menu -->
        <div class="flex items-center space-x-4">
            <!-- Cart -->
            <a href="{{ route('cart.view') }}" id="cart-link" class="relative hover:text-yellow-300 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m4-9l2 9" />
                </svg>
                <span id="cart-count"
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2">
                    {{ count(session('cart', [])) }}
                </span>
            </a>

            <!-- Mobile menu button -->
            <button id="mobile-menu-button" class="md:hidden focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-indigo-700">
        <a href="#" class="block px-6 py-3 hover:bg-blue-600 transition-colors">Home</a>
        <a href="#" class="block px-6 py-3 hover:bg-blue-600 transition-colors">Shop</a>
        <a href="#" class="block px-6 py-3 hover:bg-blue-600 transition-colors">About</a>
        <a href="#" class="block px-6 py-3 hover:bg-blue-600 transition-colors">Contact</a>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</header>

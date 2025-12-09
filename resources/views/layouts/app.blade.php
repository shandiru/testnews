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

</body>



</html>

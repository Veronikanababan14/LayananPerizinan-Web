<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    

        
<body class="bg-white text-black">
    @unless (request()->routeIs('login') || request()->routeIs('register'))
        @include('partials.navbar')
    @endunless

    <main class="min-h-screen pt-20"> {{-- kasih padding-top setara tinggi navbar --}}
    @yield('content')
</main>


    @unless (request()->routeIs('login') || request()->routeIs('register'))
        @include('components.footer')
    @endunless
</body>
</html>

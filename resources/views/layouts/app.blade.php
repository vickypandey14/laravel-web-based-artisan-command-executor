<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @stack('styles')
    
</head>
<body class="bg-gray-50 font-sans antialiased bg-pattern">
    <nav class="bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-white text-2xl font-bold tracking-tight">Laravel Panel</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Home</a>
                    <a href="{{ route('command-runner.index') }}" class="text-white hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium transition duration-150">Command Runner</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">© <script>document.write(new Date().getFullYear())</script> Laravel Web Artisan Panel. Developed by Vivek Chandra Pandey.</p>
            <div class="mt-2">
                <a href="https://bytewebster.com" class="text-indigo-300 hover:text-indigo-100 transition duration-150" target="_blank">Visit My Website</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
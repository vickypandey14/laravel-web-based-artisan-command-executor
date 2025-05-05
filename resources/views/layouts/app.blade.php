<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Web Artisan Tool</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for enhanced UI */
        .hero-bg {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        .btn-primary {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .feature-icon {
            font-size: 1.5rem;
            color: #10b981;
        }
        .bg-pattern {
            background-image: radial-gradient(circle, rgba(0, 0, 0, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        footer {
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
        }
    </style>
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
</body>
</html>
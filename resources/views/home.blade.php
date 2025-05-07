@extends('layouts.app')

@section('title', 'Home - Laravel Web Artisan Tool')

@section('content')

@push('styles')  
    <style>
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
@endpush

<div class="hero-bg text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-6xl font-extrabold mb-4 tracking-tight animate-fade-in">Laravel Web Based Artisan Command Executor 💻</h1>
        <p class="text-lg sm:text-xl max-w-3xl mx-auto mb-8 opacity-90">Effortlessly execute Laravel artisan commands from your browser—no SSH or terminal required.</p>
        <a href="{{ route('command-runner.index') }}" class="btn-primary inline-block bg-white text-indigo-600 font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-gray-100 transition duration-150">Launch Command Runner</a>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl shadow-xl p-8 transform hover:scale-105 transition duration-300">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Features</h2>
            <ul class="space-y-4">
                <li class="flex items-start">
                    <span class="feature-icon mr-3">🚀</span>
                    <span class="text-gray-700">Run artisan commands directly from an intuitive UI</span>
                </li>
                <li class="flex items-start">
                    <span class="feature-icon mr-3">⚙️</span>
                    <span class="text-gray-700">Quick-access buttons for Models, Controllers, Seeders, and more</span>
                </li>
                <li class="flex items-start">
                    <span class="feature-icon mr-3">📜</span>
                    <span class="text-gray-700">View command history with detailed output</span>
                </li>
                <li class="flex items-start">
                    <span class="feature-icon mr-3">📋</span>
                    <span class="text-gray-700">Select from a dropdown of predefined commands</span>
                </li>
                <li class="flex items-start">
                    <span class="feature-icon mr-3">🔒</span>
                    <span class="text-gray-700">Confirmation prompts for safe command execution</span>
                </li>
            </ul>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8 transform hover:scale-105 transition duration-300">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Meet the Creator</h2>
            <p class="text-gray-700 mb-4">Crafted with passion by <span class="font-medium text-indigo-600">Vivek Chandra Pandey (Vicky)</span>, a full-stack developer from India.</p>
            <p class="text-gray-700 mb-6">Fueled by a drive for clean code and innovative solutions, Vicky builds tools to supercharge developer productivity across the web.</p>
            <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-3 sm:space-y-0">
                <a href="https://bytewebster.com" target="_blank" class="btn-primary inline-block bg-indigo-600 text-white font-semibold px-6 py-3 rounded-full shadow-md hover:bg-indigo-700 transition duration-150 text-center">Visit My Blog Website</a>
                <a href="https://github.com/vickypandey14" target="_blank" class="btn-primary inline-block bg-gray-800 text-white font-semibold px-6 py-3 rounded-full shadow-md hover:bg-gray-900 transition duration-150 text-center">View My GitHub</a>
            </div>
        </div>
    </div>

    <div class="mt-16 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Why Choose Laravel Panel?</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">Streamline your Laravel development with a user-friendly interface that simplifies command execution and boosts productivity.</p>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-indigo-50 rounded-xl p-6">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">Fast & Efficient</h3>
                <p class="text-gray-600">Execute commands instantly without leaving your browser.</p>
            </div>
            <div class="bg-indigo-50 rounded-xl p-6">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">User-Friendly</h3>
                <p class="text-gray-600">Intuitive design for developers of all skill levels.</p>
            </div>
            <div class="bg-indigo-50 rounded-xl p-6">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">Secure</h3>
                <p class="text-gray-600">Built-in safeguards to prevent accidental command execution.</p>
            </div>
        </div>
    </div>
</div>
@endsection
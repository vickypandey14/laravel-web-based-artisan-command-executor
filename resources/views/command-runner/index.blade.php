@extends('layouts.app')

@section('title', 'Laravel Artisan Command Runner Tool')

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
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-8 text-center">Laravel Artisan Command Runner</h1>

    {{-- Flash output --}}
    <div id="output-container" class="hidden bg-indigo-50 border-l-4 border-indigo-500 p-4 mb-6 rounded-lg shadow-sm">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-indigo-600">Command Output:</h3>
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m9-3A9 9 0 113 12a9 9 0 0118 0z"></path>
            </svg>
        </div>
        <pre id="output" class="mt-2 text-sm text-gray-700 bg-gray-100 p-3 rounded-md overflow-x-auto whitespace-pre-wrap"></pre>
    </div>

    {{-- Command Form --}}
    <div class="bg-gray-50 p-6 rounded-2xl shadow-md mb-8 border border-gray-200">
        <form id="commandForm" class="space-y-5">
            @csrf
            <div>
                <label for="command" class="block text-sm font-medium text-gray-900 mb-2">Enter Artisan Command</label>
                <div class="relative">
                    <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-teal-300 focus:border-teal-500 transition-all duration-200" name="command" id="command" placeholder="e.g. make:model Post -mcr" required>
                    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
            </div>
    
            {{-- Dropdown --}}
            <div>
                <label class="block text-sm font-medium text-gray-900 mb-2">Common Commands</label>
                <div class="relative">
                    <select id="command-select" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-teal-300 focus:border-teal-500 transition-all duration-200 appearance-none">
                        <option value="">Select a command</option>
                        @foreach($commonCommands as $cmd)
                            <option value="{{ $cmd }}">{{ $cmd }}</option>
                        @endforeach
                    </select>
                    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
    
            {{-- Instant Action Buttons --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                <button type="button" class="btn-primary bg-gray-700 text-white font-medium px-3 py-2 rounded-xl shadow-sm hover:bg-gray-800 hover:shadow-md transition-all duration-200 flex items-center justify-center space-x-2" data-command="make:model ModelName -mcr">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6"></path>
                    </svg>
                    <span class="text-sm">Model + Migration + Controller</span>
                </button>
                <button type="button" class="btn-primary bg-gray-700 text-white font-medium px-3 py-2 rounded-xl shadow-sm hover:bg-gray-800 hover:shadow-md transition-all duration-200 flex items-center justify-center space-x-2" data-command="make:controller ResourceController --resource">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4"></path>
                    </svg>
                    <span class="text-sm">Resource Controller</span>
                </button>
                <button type="button" class="btn-primary bg-gray-700 text-white font-medium px-3 py-2 rounded-xl shadow-sm hover:bg-gray-800 hover:shadow-md transition-all duration-200 flex items-center justify-center space-x-2" data-command="make:middleware CustomMiddleware">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-2.21 1.79-4 4-4s4 1.79 4 4-1.79 4-4 4-4-1.79-4-4z"></path>
                    </svg>
                    <span class="text-sm">Middleware</span>
                </button>
                <button type="button" class="btn-primary bg-gray-700 text-white font-medium px-3 py-2 rounded-xl shadow-sm hover:bg-gray-800 hover:shadow-md transition-all duration-200 flex items-center justify-center space-x-2" data-command="make:seeder SampleSeeder">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="text-sm">Seeder</span>
                </button>
                <button type="button" class="btn-primary bg-gray-700 text-white font-medium px-3 py-2 rounded-xl shadow-sm hover:bg-gray-800 hover:shadow-md transition-all duration-200 flex items-center justify-center space-x-2" data-command="make:factory SampleFactory">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a2 2 0 012-2h2a2 2 0 012 2v5m-4 0h4"></path>
                    </svg>
                    <span class="text-sm">Factory</span>
                </button>
            </div>
    
            <br>
            <button style="background: #1dc0ff;" type="submit" class="bg-teal-600 text-white font-semibold px-6 py-2.5 rounded-xl shadow-md hover:bg-teal-700 hover:shadow-xl focus:ring-2 focus:ring-teal-400 focus:ring-opacity-50 transition-all duration-200 w-full sm:w-auto flex items-center justify-center">
                <span id="run-btn-text">Run Command</span>
                <svg id="loading-spinner" class="hidden animate-spin w-5 h-5 ml-2 text-white" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
            </button>
        </form>
    </div>

    {{-- History --}}
    <div class="flex items-center justify-between mb-4">
        <h4 class="text-2xl font-semibold text-gray-900">Command History</h4>
        <button id="clear-history" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Clear History</button>
    </div>
    <div id="history-container" class="space-y-4">
        @foreach($logs as $log)
            <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl">
                <div class="flex items-center justify-between">
                    <h5 class="text-lg font-medium text-gray-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4"></path>
                        </svg>
                        {{ $log->command }}
                    </h5>
                    <p class="text-xs text-gray-500">{{ $log->created_at->diffForHumans() }}</p>
                </div>
                <pre class="mt-2 text-sm text-gray-700 bg-gray-100 p-3 rounded-md overflow-x-auto whitespace-pre-wrap">{{ $log->output }}</pre>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
{{-- jQuery, SweetAlert2, and JavaScript --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#commandForm').on('submit', function(e) {
            e.preventDefault();
            const command = $('#command').val();

            Swal.fire({
                title: 'Confirm Command',
                text: `Are you sure you want to run: "${command}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Run Command',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#run-btn-text').text('Running...');
                    $('#loading-spinner').removeClass('hidden');

                    $.ajax({
                        url: "{{ route('command-runner.run') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            command: command
                        },
                        success: function(response) {
                            $('#run-btn-text').text('Run Command');
                            $('#loading-spinner').addClass('hidden');

                            $('#output').text(response.output);

                            const now = new Date().toISOString();
                            const diffForHumans = 'just now';
                            const historyItem = `
                                <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl">
                                    <div class="flex items-center justify-between">
                                        <h5 class="text-lg font-medium text-gray-800 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4"></path>
                                            </svg>
                                            ${command}
                                        </h5>
                                        <p class="text-xs text-gray-500">${diffForHumans}</p>
                                    </div>
                                    <pre class="mt-2 text-sm text-gray-700 bg-gray-100 p-3 rounded-md overflow-x-auto whitespace-pre-wrap">${response.output}</pre>
                                </div>
                            `;
                            $('#history-container').prepend(historyItem);

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Command Executed!',
                                text: `"${command}" ran successfully.`,
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true
                            });

                            // Clear input
                            $('#command').val('');
                        },
                        error: function(xhr) {
                            // Hide loading spinner
                            $('#run-btn-text').text('Run Command');
                            $('#loading-spinner').addClass('hidden');

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to run command. Please try again.',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true
                            });
                        }
                    });
                }
            });
        });

        $('.btn-primary[data-command]').on('click', function() {
            const cmd = $(this).data('command');
            $('#command').val(cmd);
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Command Set!',
                text: `"${cmd}" is ready to run.`,
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true
            });
        });

        $('#command-select').on('change', function() {
            const cmd = $(this).val();
            if (cmd) {
                $('#command').val(cmd);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Command Set!',
                    text: `"${cmd}" is ready to run.`,
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            }
        });

        $('#clear-history').on('click', function() {
            Swal.fire({
                title: 'Clear History?',
                text: 'This will remove all command history. Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Clear',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('command-runner.clear-history') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#history-container').empty();
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'History Cleared!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to clear history. Please try again.',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush

@endsection
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lumea') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen" style="background-image: linear-gradient(to right, #AA404A, #212121);">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        @if(session('error'))
            <div class="flex justify-center">
                <div class="max-w-md w-full mt-8">
                    <div id="alert" class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative">
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <button type="button" onclick="document.getElementById('alert').style.display = 'none';">
                                <svg class="fill-current h-6 w-6 text-red-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                </svg>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="flex justify-center">
                <div class="max-w-md w-full mt-6">
                    <div id="alert" class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <button type="button" onclick="document.getElementById('alert').style.display = 'none';">
                                <svg class="fill-current h-6 w-6 text-green-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                </svg>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        @endif

        <!-- About us -->
        <div class="container mx-auto px-4 py-6">
            <div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow-md">
                <h1 class="text-4xl font-bold mb-6 text-center">About Us</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="flex justify-center">
                        <img src="https://via.placeholder.com/300" alt="Our Team" class="w-full h-auto rounded-lg shadow-md">
                    </div>
                    <div class="flex flex-col justify-center">
                        <p class="text-gray-700 mb-4">
                            Welcome to our company! We are dedicated to providing the best service possible. Our team of professionals is committed to helping you achieve your goals. We believe in quality, integrity, and customer satisfaction. Thank you for choosing us. We look forward to serving you.
                        </p>
                        <p class="text-gray-700">
                            Our mission is to deliver high-quality products that bring value to our customers. We continuously strive to improve our services and exceed your expectations.
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="flex flex-col items-center">
                        <img src="https://via.placeholder.com/200" alt="Team Member 1" class="w-40 h-40 rounded-full mb-4 shadow-md">
                        <h2 class="text-xl font-semibold mb-2">Team Member 1</h2>
                        <p class="text-gray-500 text-center">Position</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="https://via.placeholder.com/200" alt="Team Member 2" class="w-40 h-40 rounded-full mb-4 shadow-md">
                        <h2 class="text-xl font-semibold mb-2">Team Member 2</h2>
                        <p class="text-gray-500 text-center">Position</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="https://via.placeholder.com/200" alt="Team Member 3" class="w-40 h-40 rounded-full mb-4 shadow-md">
                        <h2 class="text-xl font-semibold mb-2">Team Member 3</h2>
                        <p class="text-gray-500 text-center">Position</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>

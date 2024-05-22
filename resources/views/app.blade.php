<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumea - App</title>

    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
</head>
<body class="bg-gradient-to-b from-red-600 to-gray-900 text-white min-h-screen flex items-center justify-center">

<div class="container mx-auto">
    <div class="flex justify-center">
        <livewire:polling-livewire-component />
    </div>

    <div class="no-more-cards hidden">
        <p>No more songs to vote on.</p>
    </div>

</div>

<!-- Home Button -->
<a href="{{ route('home') }}" class="fixed bottom-8 z-50">
    <img src="{{ asset('/images/Home.webp') }}" alt="Home" class="w-7 h-7">
</a>

<script defer src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8/hammer.min.js"></script>
@vite(['resources/css/stylesapp.css', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/swipecards.js'])
@livewireScripts
</body>
</html>

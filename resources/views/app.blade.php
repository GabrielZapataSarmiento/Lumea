<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumea - App</title>

    @vite(['resources/css/stylesapp.css', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/swipecards.js'])

    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8/hammer.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
</head>
<body class="bg-gradient-to-b from-red-600 to-gray-900 text-white">

<div class="flex justify-center items-center min-h-screen">
    <div class="container">
        <div class="flex justify-center">

            <livewire:polling-livewire-component />

        </div>
    </div>
</div>


<a href="{{ route('home') }}" class="home-button" style="z-index: 9999;">
    <img src="{{asset('/images/Home.png')}}" alt="Home">
</a>

@livewireScripts

</body>
</html>



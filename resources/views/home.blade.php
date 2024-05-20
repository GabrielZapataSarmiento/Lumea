<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumea</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        .outfit {
            font-family: "Nunito Sans", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }
        .bold {
            font-family: "Nunito Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 900;
            font-style: normal;
        }

        .gradient-text {
            background: linear-gradient(to bottom, #dc2626, #1f2937);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

</head>
<body class="outfit bg-gradient-to-b from-red-600 to-gray-900 text-white">


<!-- Navigation -->
@include('layouts.navigation')

<!-- Hero Section -->
<!-- Hero Section with Video -->
<div class="relative bg-yellow-300 overflow-hidden" style="height: 100vh;">
    <video id="heroVideo" class="absolute z-0 w-full h-full object-cover cursor-pointer" autoplay muted loop playsinline onclick="toggleVideo()">
        <source src="{{ asset('LumeaTrailer.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <!-- Overlay Content -->





        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="px-4 text-center">
                <div class="">
                <h1 class="text-7xl font-bold text-red-900 mb-6">MAKE THE FIRST MOVE</h1>
                <p class="text-2xl text-red-900 mb-8">With Lumea, you make a Difference</p>
                </div>
                <button class="bg-white text-black py-3 px-6 rounded-full text-lg shadow-lg hover:bg-gray-300 transition duration-300"> <a href="{{ route('app') }}" ">Get Started</a></button>
            </div>
        </div>
    </div>





<div class="max-w-6xl mx-auto p-12 rounded-lg flex items-center">
    <div class="w-1/2 pr-8">
        <h1 class="text-7xl font-bold text-gray-900 mb-6">CHOOSE WHATS BEING PLAYED</h1>
        <p class="text-2xl text-gray-800 mb-8">Browse through music and find something that matches your interests.</p>
        <button class="bg-black text-white py-3 px-6 rounded-full text-lg shadow-lg hover:bg-gray-900 transition duration-300">Look what's new</button>
    </div>
    <div class="w-1/2">
        <img src="{{ asset('/images/Ibiza.png') }}" alt="Smiling person" class="rounded-lg">
    </div>
</div>



<div class="w-full bg-white px-4 py-12">
    <h1 class="text-center text-5xl font-bold mb-12 text-black">SO MUCH MORE COMING SOON</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
        <div class="flex flex-col items-center text-center mb-8">
            <img src="{{ asset('/images/Submitted.png') }}" alt="Feature 1" class="rounded-lg object-cover h-auto mb-4">
            <h3 class="font-bold text-2xl mb-2 text-black">Discover new music</h3>
            <p class="text-lg text-black">See what music is playing in realtime and add these to your playlist or prefrences.</p>
        </div>
        <div class="flex flex-col items-center text-center mb-8">
            <img src="{{ asset('/images/Messages.png') }}" alt="Feature 2" class="rounded-lg object-cover h-auto mb-4">
            <h3 class="font-bold text-2xl mb-2 text-black">Meet someone with Lumea</h3>
            <p class="text-lg text-black">Find someone that you want to be friends with and connect on a different level.</p>
        </div>
        <div class="flex flex-col items-center text-center mb-8">
            <img src="{{ asset('/images/Find Parties.png') }}" alt="Feature 3" class="rounded-lg object-cover h-auto mb-4">
            <h3 class="font-bold text-2xl mb-2 text-black">Attend our Lumea's parties</h3>
            <p class="text-lg text-black">See where and when our parties are. So you can have a unique experience everytime.</p>
        </div>
    </div>
</div>


<div class="w-full s px-4 py-12">
    <h1 class="text-center text-5xl font-bold mb-12 text-white">Meet the Lumea Team</h1>
    <div class="flex justify-center space-x-8 max-w-6xl mx-auto">
        <!-- Team Member 1 -->
        <div class="flex flex-col items-center text-center mb-8">
            <img src="{{ asset('/images/mc.jpg') }}" alt="Team Member 1" class="rounded-full object-cover h-48 w-48 mb-4">
            <h3 class="font-bold text-2xl mb-2 text-white">Marc Anthony Surmont</h3>
        </div>
        <!-- Team Member 2 -->
        <div class="flex flex-col items-center text-center mb-8">
            <img src="{{ asset('/images/gz.jpg') }}" alt="Team Member 2" class="rounded-full object-cover h-48 w-48 mb-4">
            <h3 class="font-bold text-2xl mb-2 text-white">Gabriel Zapata Sarmiento</h3>
            <p class="text-lg text-gray-700"></p>
        </div>
    </div>
</div>




<!-- Footer -->
<footer class="bg-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4 py-6">
        <div class="text-center text-gray-600">
            © 2023 Lumea. All rights reserved.
        </div>
    </div>
</footer>
</body>
</html>

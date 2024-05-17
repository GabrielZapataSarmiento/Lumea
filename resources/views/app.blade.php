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

</head>
<body class="bg-gradient-to-b from-red-600 to-gray-900 text-white">

<div class="flex justify-center items-center min-h-screen">
    <div class="container">
        <div class="flex justify-center">

            <div class="card">
                <div class="cover">
                    <img src="{{ asset('/images/picture.png') }}" alt="cover" class="object-cover w-full h-full rounded-lg pl-4 pr-4 pt-4 pb-2" draggable="false">
                </div>

                <div class="card-content pl-4 pb-4">
                    <h4>Artist name</h4>
                    <p>Song title</p>
                </div>

                <div class="swipe-buttons flex justify-center">
                    <button id="dislikeButton"><img src="{{asset('/images/red button.png')}}" alt="Dislike"></button>
                    <button id="likeButton"><img src="{{asset('/images/green button.png')}}" alt="Like"></button>
                </div>
            </div>

            <div class="card">
                <div class="cover">
                    <img src="{{ asset('/images/picture.png') }}" alt="cover" class="object-cover w-full h-full rounded-lg pl-4 pr-4 pt-4 pb-2" draggable="false">
                </div>

                <div class="card-content pl-4 pb-4">
                    <h4>Artist name</h4>
                    <p>Song title</p>
                </div>

                <div class="swipe-buttons flex justify-center">
                    <button id="dislikeButton"><img src="{{asset('/images/red button.png')}}" alt="Dislike"></button>
                    <button id="likeButton"><img src="{{asset('/images/green button.png')}}" alt="Like"></button>
                </div>
            </div>


        </div>
    </div>
</div>


<a href="{{ route('home') }}" class="home-button" style="z-index: 9999;">
    <img src="{{asset('/images/Home.png')}}" alt="Home">
</a>


</div>
</body>
</html>



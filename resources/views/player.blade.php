<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css"
    />
    <title>Lumea - Player</title>
</head>
<body class="bg-gradient-to-b from-red-600 to-gray-900 text-white min-h-screen flex items-center justify-center">

<h1>Music Player</h1>

<div class="music-container" id="music-container">
    <div class="music-info">
        <h4 id="title"></h4>
        <div class="progress-container" id="progress-container">
            <div class="progress" id="progress"></div>
        </div>
    </div>

    <audio src="{{ asset('/songs/something.mp3') }}" id="audio"></audio>

    <div class="img-container">
        <img src="{{ asset('/images/something.png') }}" alt="music-cover" id="cover" />
    </div>
    <div class="navigation">
        <button id="prev" class="action-btn">
            <i class="fas fa-backward"></i>
        </button>
        <button id="play" class="action-btn action-btn-big">
            <i class="fas fa-play"></i>
        </button>
        <button id="next" class="action-btn">
            <i class="fas fa-forward"></i>
        </button>
    </div>
</div>
@vite(['resources/css/stylesplayer.css', 'resources/js/script.js'])
</body>
</html>

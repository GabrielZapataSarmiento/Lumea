<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lumea - Player</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/ICON.webp') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');
        body {
            font-family: 'Outfit', sans-serif;
        }
        #songs-list .bg-gray-200 {
            background-color: #f0f0f0;
        }
        #songs-list .rounded-full {
            border-radius: 9999px;
        }
        .fade-in {
            animation: fadeIn 1s;
        }
        .fade-out {
            animation: fadeOut 1s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(10px); }
        }
    </style>
</head>
<body class="bg-gradient-to-b from-red-600 to-gray-900 text-white min-h-screen flex flex-col">
<div class="w-full max-w-6xl mx-auto px-4 py-2 overflow-auto">
    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
        <div class="md:w-1/2">
        <div class="music-container" id="music-container">
            <div class="music-info">
                    <h2 id="title" class="font-bold text-white"></h2>
                    <p id="artist" class="text-gray-400"></p>
                <div class="progress-container" id="progress-container">
                    <div class="progress" id="progress"></div>
                </div>
            </div>
            <audio src="#" id="audio"></audio>
            <div class="img-container">
                <img src="#" alt="music-cover" id="cover" />
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
    </div>
    <div class="w-1/2">
        <div id="songs-list" class="space-y-4"></div>
    </div>
</div>
<script>
    let previousData = [];
    function fetchSongs() {
        $.ajax({
            url: '/app/songs',
            method: 'GET',
            success: function(data) {
                var songsList = $('#songs-list');
                songsList.empty();
                data.songs.forEach(function(song, index) {
                    let previousIndex = previousData.findIndex(prevSong => prevSong.id === song.id);
                    let animationClass = '';
                    if (previousIndex !== -1) {
                        if (previousIndex > index) {
                            animationClass = 'fade-in';
                        } else if (previousIndex < index) {
                            animationClass = 'fade-out';
                        }
                    }
                    songsList.append( '<div class="bg-white text-black p-4 rounded-lg shadow-lg flex items-center space-x-4 ' + animationClass + '">' +
                        '<img src="/images/' + song.song_path + '.webp" alt="' + song.title + '" class="w-16 h-16 object-cover rounded-full">' +
                        '<div class="flex-grow">' +
                        '<h2 class="text-xl font-semibold">' + song.title + '</h2>' +
                        '<h3 class="text-md text-gray-500 font-semibold">' + song.artist + '</h3>' +
                        '</div>' +
                        '<div class="bg-gray-200 text-black py-2 px-4 rounded-full ml-auto">' +
                        '<p class="text-lg font-semibold">' + song.total_count + ' votes</p>' +
                        '</div>' +
                        '</div>'
                    );
                });
                previousData = data.songs;
            }
        });
    }
    $(document).ready(function() {
        fetchSongs();
        setInterval(fetchSongs, 5000); // Update every 5 seconds
    });
</script>
@vite(['resources/css/stylesplayer.css', 'resources/js/script.js'])
</body>
</html>

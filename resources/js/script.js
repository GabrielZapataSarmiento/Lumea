const musicContainer = document.getElementById('music-container');
const playBtn = document.getElementById('play');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');

const audio = document.getElementById('audio');
const progress = document.getElementById('progress');
const progressContainer = document.getElementById('progress-container');
const title = document.getElementById('title');
const cover = document.getElementById('cover');
const currTime = document.querySelector('#currTime');
const durTime = document.querySelector('#durTime');

// Fetch songs from the Laravel endpoint
let songs = [];
let songArrayIndex = 0;

// Fetch songs from the Laravel endpoint
function fetchSongs() {
    $.ajax({
        url: '/app/songs',
        method: 'GET',
        success: function(data) {
            // Update the songs array with the fetched data
            songs = data.songs;

            loadSong(songs[0]);

            setTimeout(() => {
                playSong();
            }, 1000);
        },
        error: function(error) {
            console.error('Error fetching songs:', error);
        }
    });
}

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

async function setSongAsPlayed(songId) {
    console.log(`Setting song ${songId} as played`);
    try {
        const response = await fetch('/app/setPlayed', { // Ensure this URL matches your route
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            body: JSON.stringify({ id: songId })
        });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        if (data.success) {
            console.log('Song has been marked as played.');
        } else {
            console.error('Failed to mark the song as played.');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}



// Update song details
function loadSong(song) {

    title.innerText = song.title;
    audio.src = `./songs/${song.song_path}.mp3`;
    cover.src = `./images/${song.song_path}.webp`;

    setSongAsPlayed(song.id);

}

// Play song
function playSong() {
    musicContainer.classList.add('play');
    playBtn.querySelector('i.fas').classList.remove('fa-play');
    playBtn.querySelector('i.fas').classList.add('fa-pause');

    audio.play();


}

// Pause song
function pauseSong() {
    musicContainer.classList.remove('play');
    playBtn.querySelector('i.fas').classList.add('fa-play');
    playBtn.querySelector('i.fas').classList.remove('fa-pause');

    audio.pause();
}

// Previous song
function prevSong() {
    songArrayIndex--;

    if (songArrayIndex < 0) {
        songArrayIndex = songs.length - 1;
    }

    loadSong(songs[songArrayIndex]);
    playSong();
}

function nextSong() {
    songArrayIndex++;

    if (songArrayIndex > songs.length - 1) {
        songArrayIndex = 0;
    }

    // Fetch the latest songs data before playing the next song
    fetchSongs();

    // Ensure the song is loaded and played after fetching new data
    setTimeout(() => {
        loadSong(songs[songArrayIndex]);
        playSong();
    }, 500);
}

$(document).ready(function() {
    fetchSongs();

    // Set up event listener for when the song ends
    $('#audio').on('ended', function() {
        isPlaying = false;
        nextSong();
    });

    // Update the songs array in the background every minute
    setInterval(() => {
        if (!isPlaying) {
            fetchSongs();
        }
    }, 60000); // Update every 60 seconds
});

// Update progress bar
function updateProgress(e) {
    const { duration, currentTime } = e.srcElement;
    const progressPercent = (currentTime / duration) * 100;
    progress.style.width =     `${progressPercent}%`;
}

// Set progress bar
function setProgress(e) {
    const width = this.clientWidth;
    const clickX = e.offsetX;
    const duration = audio.duration;

    audio.currentTime = (clickX / width) * duration;
}

// Get duration & currentTime for Time of song
function DurTime(e) {
    const { duration, currentTime } = e.srcElement;
    let sec;
    let sec_d;

    // Define minutes currentTime
    let min = (currentTime == null) ? 0 : Math.floor(currentTime / 60);
    min = min < 10 ? '0' + min : min;

    // Define seconds currentTime
    function get_sec(x) {
        if (Math.floor(x) >= 60) {
            for (let i = 1; i <= 60; i++) {
                if (Math.floor(x) >= (60 * i) && Math.floor(x) < (60 * (i + 1))) {
                    sec = Math.floor(x) - (60 * i);
                    sec = sec < 10 ? '0' + sec : sec;
                }
            }
        } else {
            sec = Math.floor(x);
            sec = sec < 10 ? '0' + sec : sec;
        }
    }

    get_sec(currentTime);

    // Change currentTime DOM
    currTime.innerHTML = min + ':' + sec;

    // Define minutes duration
    let min_d = (isNaN(duration) === true) ? '0' : Math.floor(duration / 60);
    min_d = min_d < 10 ? '0' + min_d : min_d;

    function get_sec_d(x) {
        if (Math.floor(x) >= 60) {
            for (let i = 1; i <= 60; i++) {
                if (Math.floor(x) >= (60 * i) && Math.floor(x) < (60 * (i + 1))) {
                    sec_d = Math.floor(x) - (60 * i);
                    sec_d = sec_d < 10 ? '0' + sec_d : sec_d;
                }
            }
        } else {
            sec_d = (isNaN(duration) === true) ? '0' : Math.floor(x);
            sec_d = sec_d < 10 ? '0' + sec_d : sec_d;
        }
    }

    get_sec_d(duration);

    // Change duration DOM
    durTime.innerHTML = min_d + ':' + sec_d;
}

// Event listeners
playBtn.addEventListener('click', () => {
    const isPlaying = musicContainer.classList.contains('play');

    if (isPlaying) {
        pauseSong();
    } else {
        playSong();
    }
});

// Change song
prevBtn.addEventListener('click', prevSong);
nextBtn.addEventListener('click', nextSong);

// Time/song update
audio.addEventListener('timeupdate', updateProgress);

// Click on progress bar
progressContainer.addEventListener('click', setProgress);

// Song ends
audio.addEventListener('ended', nextSong);

// Time of song
audio.addEventListener('timeupdate', DurTime);

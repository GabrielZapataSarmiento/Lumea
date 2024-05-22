document.addEventListener('DOMContentLoaded', function () {
    let lastVoteTime = 0; // Timestamp of the last vote
    const VOTE_DELAY = 1000; // Minimum delay between votes.blade.php in milliseconds

    function createButtonListener(love) {
        return function (event) {
            var card = event.target.closest('.card');
            if (!card) return;

            var voteType = love ? 'like' : 'dislike';
            console.log('Vote type:', voteType); // Log the voteType
            var moveOutWidth = document.body.clientWidth * 1;
            card.style.transform = 'translate(' + (love ? moveOutWidth : -moveOutWidth) + 'px, -100px) rotate(' + (love ? -15 : 15) + 'deg)';
            card.style.opacity = '0'; // Reduce opacity while moving

            const currentTime = Date.now();
            if (currentTime - lastVoteTime >= VOTE_DELAY) {
                lastVoteTime = currentTime;
                if (voteType === 'like') {
                    sendVote(card.getAttribute('data-song-id'), voteType, card);
                }
            }

            setTimeout(function () {
                card.remove();
                checkIfAllVoted();
            }, 500);

            event.preventDefault();
        };
    }

    var dislikeButtons = document.querySelectorAll('.swipe-buttons button:first-child');
    var likeButtons = document.querySelectorAll('.swipe-buttons button:last-child');

    dislikeButtons.forEach(button => {
        button.addEventListener('click', createButtonListener(false));
    });

    likeButtons.forEach(button => {
        button.addEventListener('click', createButtonListener(true));
    });

    function sendVote(songId, voteType, card) {
        console.log(`Sending vote for songId: ${songId}, voteType: ${voteType}`);
        // Your fetch code for sending the vote
    }

    function checkIfAllVoted() {
        var remainingCards = document.querySelectorAll('.card:not(.removed)').length;
        var noMoreCards = document.querySelector('.no-more-cards');
        if (remainingCards === 0) {
            noMoreCards.classList.remove('hidden');
        } else {
            noMoreCards.classList.add('hidden');
        }
    }

    function initCards() {
        var newCards = document.querySelectorAll('.card:not(.removed)');
        newCards.forEach(function (card, index) {
            var offset = index * 2; // Adjust this value to control the offset between cards
            card.style.cssText = 'z-index: ' + (newCards.length - index) +
                '; transform: translate(-50%, calc(-50% + ' + offset + 'px)); opacity: 1; position: absolute; left: 50%; top: calc(50% - ' + offset + 'px); transition: transform 0.5s ease, opacity 0.5s ease'; // Add opacity transition here
        });
        checkIfAllVoted(newCards.length);
    }

    // Listen for the custom event emitted by Livewire
    document.addEventListener('songsLoaded', function () {
        initCards(); // Reinitialize cards after songs are loaded
    });

    // Call initCards when the DOM is loaded
    initCards();
});

document.addEventListener('DOMContentLoaded', function () {
    Livewire.dispatch('loadSongs');
});

setInterval(function () {
    Livewire.dispatch('loadSongs');
}, 15000);

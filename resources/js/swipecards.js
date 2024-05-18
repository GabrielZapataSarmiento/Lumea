document.addEventListener('DOMContentLoaded', function () {
    var allCards = document.querySelectorAll('.card');
    var dislikeButtons = document.querySelectorAll('.swipe-buttons button:first-child');
    var likeButtons = document.querySelectorAll('.swipe-buttons button:last-child');

    var moveOutWidth = document.body.clientWidth;
    var threshold = 50;

    function initCards() {
        var newCards = document.querySelectorAll('.card:not(.removed)');
        newCards.forEach(function (card, index) {
            card.style.cssText = 'z-index: ' + (newCards.length - index) +
                '; transform: none; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);';
        });
        checkIfAllVoted(newCards.length);
    }

    initCards();

    var center = window.innerWidth / 2;
    var blurMaxRadius = 20;

    allCards.forEach(function (el) {
        var hammertime = new Hammer(el);
        var translateX = 0;
        var translateY = 0;
        var blurIntensity = 0;

        hammertime.get('pan').set({ direction: Hammer.DIRECTION_HORIZONTAL, threshold: 5 });

        hammertime.on('panstart', function (event) {
            el.classList.add('moving');
            var cardRect = el.getBoundingClientRect();
            if (event.center.x !== center) {
                // Check if the movement is primarily horizontal
                if (Math.abs(event.deltaX) > Math.abs(event.deltaY)) {
                    blurIntensity = calculateBlurIntensity(event.center.x, window.innerWidth);
                    el.style.filter = 'blur(' + blurIntensity + 'px)';
                } else {
                    // If the movement is not horizontal, reset the blur effect
                    el.style.filter = 'none';
                }
            }
        });

        hammertime.on('pan', function (event) {
            translateX = event.deltaX * 0.5;
            translateY = event.deltaY * 0.5;

            // Check if the movement is primarily horizontal
            if (Math.abs(event.deltaX) > Math.abs(event.deltaY)) {
                // Horizontal movement: adjust the card's position
                var angle = translateX * 0.1;
                if (angle > 15) angle = 15;
                if (angle < -15) angle = -15;
                blurIntensity = calculateBlurIntensity(center + translateX, window.innerWidth);
                el.style.transform = 'translate(' + (translateX - 50) + '%, -50%) rotate(' + angle + 'deg)'; // Adjust translateY to keep the card centered vertically
                el.style.filter = 'blur(' + blurIntensity + 'px)';
            }
        });


        hammertime.on('panend', function (event) {
            el.classList.remove('moving');
            if (Math.abs(translateX) > threshold) {
                var toX = translateX > 0 ? moveOutWidth : -moveOutWidth;
                var rotate = translateX > 0 ? 30 : -30;
                var voteType = translateX > 0 ? 'like' : 'dislike'; // Map swipe direction to vote type
                el.style.transform = 'translate(' + toX + 'px, ' + translateY + 'px) rotate(' + rotate + 'deg)';
                el.classList.add('removed');
                sendVote(el.getAttribute('data-song-id'), voteType); // Send vote to backend
                setTimeout(function () {
                    el.remove();
                    initCards();
                }, 500);
            } else {
                el.style.transform = 'translate(-50%, -50%)';
                el.style.filter = 'none';
            }
        });

        function sendVote(songId, voteType) {
            // Send vote to backend
            fetch('/vote-song', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ songId: songId, voteType: voteType })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Vote successfully recorded:', data);
                })
                .catch(error => {
                    console.error('Error recording vote:', error);
                });
        }

    });

    function calculateBlurIntensity(cardX, screenWidth) {
        var distanceFromCenter = Math.abs(cardX - center);
        var distancePercentage = distanceFromCenter / (screenWidth / 2);
        var blurIntensity = distancePercentage * distancePercentage * blurMaxRadius;
        return blurIntensity;
    }

    function createButtonListener(love) {
        return function (event) {
            var cards = document.querySelectorAll('.card:not(.removed)');
            if (!cards.length) return false;
            var card = cards[0];
            var voteType = love ? 'like' : 'dislike';
            console.log('Vote type:', voteType); // Log the voteType
            card.classList.add('removed');
            var moveOutWidth = document.body.clientWidth * 1;
            card.style.transform = 'translate(' + (love ? moveOutWidth : -moveOutWidth) + 'px, -100px) rotate(' + (love ? -15 : 15) + 'deg)';
            if (voteType === 'like') {
                sendVote(card.getAttribute('data-song-id'), voteType, card);
            }
            setTimeout(function () {
                card.remove();
                initCards();
            }, 500);
            event.preventDefault();
        };
    }

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

    function checkIfAllVoted(remainingCards) {
        if (remainingCards === 0) {
            document.querySelector('.no-more-cards').classList.remove('hidden');
        } else {
            document.querySelector('.no-more-cards').classList.add('hidden');
        }
    }
});

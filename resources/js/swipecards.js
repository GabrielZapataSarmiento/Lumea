document.addEventListener('DOMContentLoaded', function () {
    let lastVoteTime = 0; // Timestamp of the last vote
    const VOTE_DELAY = 3000; // Minimum delay between votes in milliseconds
    let debounceTimeout;

    function createButtonListener(love) {
        return function (event) {
            const card = event.target.closest('.card');
            if (!card) return;

            const voteType = love ? 'like' : 'dislike';
            const moveOutWidth = document.body.clientWidth * 1;

            // Apply transition only when the button is clicked
            card.style.transition = 'transform 0.5s ease, opacity 0.5s ease';
            card.style.transform = `translate(${love ? moveOutWidth : -moveOutWidth}px, -100px) rotate(${love ? -15 : 15}deg)`;
            card.style.opacity = '0'; // Reduce opacity while moving

            const currentTime = Date.now();
            if (currentTime - lastVoteTime >= VOTE_DELAY) {
                lastVoteTime = currentTime;
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    // Call your existing voting system here
                    // Example: yourVotingSystem.vote(card.getAttribute('data-song-id'), voteType);
                }, 300); // Debounce delay
            }

            setTimeout(() => {
                card.remove();
                checkIfAllVoted();
            }, 500);

            event.preventDefault();
        };
    }

    function attachButtonListeners() {
        const dislikeButtons = document.querySelectorAll('.swipe-buttons button:first-child');
        const likeButtons = document.querySelectorAll('.swipe-buttons button:last-child');

        dislikeButtons.forEach(button => {
            button.removeEventListener('click', createButtonListener(false)); // Remove existing listener
                button.addEventListener('click', createButtonListener(false));
            });

            likeButtons.forEach(button => {
                button.removeEventListener('click', createButtonListener(true)); // Remove existing listener
                button.addEventListener('click', createButtonListener(true));
            });
        }

        function checkIfAllVoted() {
            const remainingCards = document.querySelectorAll('.card:not(.removed)').length;
            const noMoreCards = document.querySelector('.no-more-cards');
            if (remainingCards === 0) {
                noMoreCards.classList.remove('hidden');
            } else {
                noMoreCards.classList.add('hidden');
            }
        }

        function initCards() {
            const newCards = document.querySelectorAll('.card:not(.removed)');
            newCards.forEach((card, index) => {
                const offset = index * 2; // Adjust this value to control the offset between cards
                card.style.cssText = `z-index: ${newCards.length - index}; transform: translate(-50%, calc(-50% + ${offset}px)); opacity: 1; position: absolute; left: 50%; top: calc(50% - ${offset}px);`; // Initial styles without transition
            });

            // Apply transitions after a short delay to avoid fidgeting
            requestAnimationFrame(() => {
                newCards.forEach(card => {
                    card.style.transition = ''; // Ensure no transition initially
                });
            });

            checkIfAllVoted(newCards.length);
            attachButtonListeners(); // Attach listeners to new cards
        }

        // Listen for the custom event emitted by Livewire
        document.addEventListener('songsLoaded', function () {
            initCards(); // Reinitialize cards after songs are loaded
        });

        // Call initCards when the DOM is loaded
        initCards();

        document.addEventListener('DOMContentLoaded', function () {
            Livewire.dispatch('loadSongs');
        });

        setInterval(function () {
            Livewire.dispatch('loadSongs');
        }, 15000);

        // Use MutationObserver to detect changes in the DOM and reattach event listeners
        const observer = new MutationObserver(function (mutationsList) {
            for (const mutation of mutationsList) {
                if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                    attachButtonListeners(); // Reattach listeners when new nodes are added
                }
            }
        });

        // Start observing the target node for configured mutations
        observer.observe(document.body, { childList: true, subtree: true });
    });

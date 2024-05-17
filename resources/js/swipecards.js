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
                blurIntensity = calculateBlurIntensity(event.center.x, window.innerWidth);
                el.style.filter = 'blur(' + blurIntensity + 'px)';
            }
        });

        hammertime.on('pan', function (event) {
            translateX = event.deltaX * 0.5;
            translateY = event.deltaY * 0.5;
            var angle = translateX * 0.1;
            if (angle > 15) angle = 15;
            if (angle < -15) angle = -15;
            blurIntensity = calculateBlurIntensity(center + translateX, window.innerWidth);
            el.style.transform = 'translate(' + (translateX - 50) + '%, ' + (translateY - 50) + '%) rotate(' + angle + 'deg)';
            el.style.filter = 'blur(' + blurIntensity + 'px)';
        });

        hammertime.on('panend', function (event) {
            el.classList.remove('moving');
            if (Math.abs(translateX) > threshold) {
                var toX = translateX > 0 ? moveOutWidth : -moveOutWidth;
                var rotate = translateX > 0 ? 30 : -30;
                el.style.transform = 'translate(' + toX + 'px, ' + translateY + 'px) rotate(' + rotate + 'deg)';
                el.classList.add('removed');
                setTimeout(function() {
                    el.remove();
                    initCards();
                }, 500);
            } else {
                el.style.transform = 'translate(-50%, -50%)';
                el.style.filter = 'none';
            }
        });
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
            card.classList.add('removed');
            var moveOutWidth = document.body.clientWidth * 1;
            card.style.transform = 'translate(' + (love ? moveOutWidth : -moveOutWidth) + 'px, -100px) rotate(' + (love ? -15 : 15) + 'deg)';
            setTimeout(function() {
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
});

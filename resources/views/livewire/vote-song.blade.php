<div wire:ignore>
    <div class="card" data-song-id="{{ $song->id }}">
        <div class="cover">
            <img src="{{ asset('/images/Ibiza.png') }}" alt="cover" class="object-cover w-full h-full rounded-lg pl-4 pr-4 pt-4 pb-2" draggable="false">
        </div>
        <div class="card-content pl-4 pb-4">
            <h4>{{ $song->artist }}</h4>
            <p>{{ $song->title }}</p>
        </div>
        <div class="swipe-buttons flex justify-center">
            <button wire:click="vote('dislike')"><img src="{{ asset('/images/red button.png') }}" alt="Dislike"></button>
            <button wire:click="vote('like')"><img src="{{ asset('/images/green button.png') }}" alt="Like"></button>
        </div>
    </div>
</div>

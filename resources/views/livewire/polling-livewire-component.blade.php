<div>
    @if($songs->isEmpty())
        <div class="no-more-cards">
            <p>No more songs to vote on.</p>
        </div>
    @else
        @foreach ($songs->shuffle() as $song)
            <livewire:vote-song :song="$song" :key="$song->id" />
        @endforeach
    @endif
</div>


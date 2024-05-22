<div>

    @foreach ($songs as $song)
        <livewire:vote-song :song="$song" :key="$song->id" />
    @endforeach

</div>


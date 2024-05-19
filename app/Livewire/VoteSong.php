<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;

class VoteSong extends Component
{
    public $song;

    public function mount(Song $song)
    {
        $this->song = $song;
    }

    public function vote($voteType)
    {
        $user = auth()->user();

        // Check if the user has already voted for this song
        $existingVote = $user->votes()->where('song_id', $this->song->id)->first();

        if ($existingVote) {
            return response()->json(['success' => false, 'message' => 'You have already voted for this song']);
        }

        // Record the vote
        $user->votes()->create([
            'song_id' => $this->song->id,
            'vote_type' => $voteType,
        ]);

        $this->dispatch('loadSongs');

        return response()->json(['success' => true]);
    }

    public function loadSongs()
    {
        $this->songs = Song::all();
        $this->dispatch('loadSongs'); // Emit the loadSongs event after loading songs
    }

    public function render()
    {
        return view('livewire.vote-song');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;

class PollingLivewireComponent extends Component
{
    public $songs = [];

    protected $listeners = ['loadSongs' => 'refreshSongs'];

    public function mount()
    {
        $this->refreshSongs(true);
    }

    public function refreshSongs($shuffle = false)
    {
        $user = Auth::user();
        $votedSongIds = $user->votes->pluck('song_id')->toArray();
        $this->songs = Song::whereNotIn('id', $votedSongIds)->get();

        if ($shuffle) {
            $this->songs = $this->songs->shuffle(); // Shuffle only on initial load
        }
    }

    public function render()
    {
        return view('livewire.polling-livewire-component', ['songs' => $this->songs]);
    }
}

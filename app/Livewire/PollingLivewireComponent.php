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
        $this->refreshSongs();
    }

    public function refreshSongs()
    {
        logger('Refreshing songs...');
        $user = Auth::user();
        $votedSongIds = $user->votes->pluck('song_id')->toArray();
        $this->songs = Song::whereNotIn('id', $votedSongIds)->get();
        logger('Songs refreshed: ', $this->songs->toArray());
    }

    public function render()
    {
        return view('livewire.polling-livewire-component', ['songs' => $this->songs]);
    }
}

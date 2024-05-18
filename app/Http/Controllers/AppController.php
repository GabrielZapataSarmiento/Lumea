<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $votedSongIds = $user->votes->pluck('song_id')->toArray();

        $songs = Song::whereNotIn('id', $votedSongIds)->get();
        return view('app', compact('songs'));
    }
}

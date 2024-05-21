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

    public function fetchSongs()
    {
        $songs = Song::all();
        return response()->json($songs);
    }

    public function getSongNames()
    {
        $songs = Song::all('title');
        return response()->json($songs);
    }
}

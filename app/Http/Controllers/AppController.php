<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Vote;
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


    public function getSongsWithVotes()
    {
        // Fetch all songs with their titles and paths
        $songs = Song::all(['id', 'title', 'song_path']);

        // Add vote counts to each song
        $songsWithVotes = $songs->map(function ($song) {
            $likeCount = Vote::where('song_id', $song->id)->where('vote_type', 'like')->count();
            $dislikeCount = Vote::where('song_id', $song->id)->where('vote_type', 'dislike')->count();
            $totalCount = $likeCount - $dislikeCount;

            return [
                'id' => $song->id,
                'title' => $song->title,
                'song_path' => $song->song_path,
                'like_count' => $likeCount,
                'dislike_count' => $dislikeCount,
                'total_count' => $totalCount,
            ];
        });

        // Sort songs by total count in descending order
        $sortedSongs = $songsWithVotes->sortByDesc('total_count')->values();

        // Return the sorted songs as a JSON response
        return response()->json([
            'songs' => $sortedSongs,
        ]);
    }

}

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

        $songs = Song::whereNotIn('id', $votedSongIds)->where('hasPlayed', 0)->get();

        return view('app', compact('songs'));
    }

    public function fetchSongs()
    {
        $songs = Song::all()->where('hasPlayed', 0);
        return response()->json($songs);
    }


    public function getSongsWithVotes()
    {
        // Fetch all songs with their titles and paths where hasPlayed is false
        $songs = Song::where('hasPlayed', false)->get(['id', 'title', 'artist', 'song_path']);

        // Add vote counts to each song
        $songsWithVotes = $songs->map(function ($song) {
            $likeCount = Vote::where('song_id', $song->id)->where('vote_type', 'like')->count();
            $dislikeCount = Vote::where('song_id', $song->id)->where('vote_type', 'dislike')->count();
            $totalCount = $likeCount - $dislikeCount;

            return [
                'id' => $song->id,
                'title' => $song->title,
                'artist' => $song->artist,
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
            'songs' => $sortedSongs->toArray(), // Convert collection to array
        ]);
    }

    public function setSongPlayed(Request $request)
    {
        $songId = $request->input('id');
        $song = Song::find($songId);

        if ($song) {
            $song->hasPlayed = true;
            $song->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }


}

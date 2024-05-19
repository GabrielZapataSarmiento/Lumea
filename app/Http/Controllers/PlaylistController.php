<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Vote;

class PlaylistController extends Controller
{
    public function updatePlaylist()
    {
        // Calculate song rankings based on votes
        $rankedSongs = $this->calculateSongRankings();

        // Update playlist logic here (e.g., play the song with the highest ranking)
        // You can return $rankedSongs to the view and render the playlist there
    }

    private function calculateSongRankings()
    {
        // Get all songs
        $songs = Song::all();

        // Initialize an empty array to store song rankings
        $rankedSongs = [];

        // Loop through each song
        foreach ($songs as $song) {
            // Count the number of likes for the song
            $likes = Vote::where('song_id', $song->id)->where('vote_type', 'like')->count();

            // Count the number of dislikes for the song
            $dislikes = Vote::where('song_id', $song->id)->where('vote_type', 'dislike')->count();

            // Calculate the total votes (likes - dislikes)
            $totalVotes = $likes - $dislikes;

            // Add the song to the ranked songs array along with its total votes
            $rankedSongs[] = [
                'song' => $song,
                'total_votes' => $totalVotes,
            ];
        }

        // Sort the ranked songs array based on total votes (descending order)
        usort($rankedSongs, function ($a, $b) {
            return $b['total_votes'] - $a['total_votes'];
        });

        return $rankedSongs;
    }
}

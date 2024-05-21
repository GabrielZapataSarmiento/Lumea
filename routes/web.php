<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\SongController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return redirect('/');
});

Route::middleware('auth')->group(function () {
    Route::get('/app', [AppController::class, 'index'])->name('app');
    Route::get('/app/fetch-songs', [AppController::class, 'fetchSongs']);
    Route::get('/app/songs', [AppController::class, 'getSongsWithVotes']);



    Route::get('/player', function (){
        return view('player');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

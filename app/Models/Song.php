<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vote;

class Song extends Model
{
    use HasFactory;

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

}

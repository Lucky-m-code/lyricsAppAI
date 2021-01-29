<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LyricsRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'music_name',
        'artist_name',
        'url'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}

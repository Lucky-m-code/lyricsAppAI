<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lyrics extends Model
{
    use HasFactory;

    protected $fillable = [
        'music_name',
        'artist_name',
        'lyrics',
        'url',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

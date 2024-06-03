<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $table = 'musics';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'artist',
        'album',
        'genre',
        'release_date',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'release_date' => 'datetime',
    ];

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }
}

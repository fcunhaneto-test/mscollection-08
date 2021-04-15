<?php

namespace App\Models\Cast;

use App\Models\Season;
use App\Models\Title;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $table = 'cast';
    public $timestamps = false;
    protected $fillable = ['actor_id', 'character_id'];

    public function titles()
    {
        return $this->belongsToMany(Title::class, 'cast_title')->withPivot('order', 'star');
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'cast_season')->withPivot('order', 'star');
    }
}

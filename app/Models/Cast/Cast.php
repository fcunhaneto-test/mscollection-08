<?php

namespace App\Models\Cast;

use App\Models\Season;
use App\Models\Title;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function castTitle($title_id)
    {
        return DB::table('cast_title')
            ->leftJoin('cast', 'cast_title.cast_id', '=', 'cast.id')
            ->leftJoin('actors', 'cast.actor_id', '=', 'actors.id')
            ->leftJoin('characters', 'cast.character_id', '=', 'characters.id')
            ->where('cast_title.title_id', '=', $title_id)
            ->where('cast_title.star', '=', true)
            ->select('cast_title.*', 'actors.name as actor', 'characters.name as character',
                'cast.actor_id', 'cast.character_id')
            ->orderBy('cast_title.order')
            ->get();
    }
}

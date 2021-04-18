<?php

namespace App\Models\Qualifiers;

use App\Models\Season;
use App\Models\Title;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $fillable = ['name', 'slug', 'active', 'stream'];

    public function titles()
    {
        return $this->belongsToMany(Title::class, 'media_title');
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'media_season');
    }

    public function streams()
    {
        return $this->where('stream', true)->where('active', true)->get();
    }
}

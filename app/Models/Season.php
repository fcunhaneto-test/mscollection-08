<?php

namespace App\Models;

use App\Models\Cast\Cast;
use App\Models\Qualifiers\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public $timestamps = false;
    protected $fillable = ['title_is', 'season', 'year'];

    public function titles()
    {
        return $this->belongsTo(Title::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function cast()
    {
        return $this->belongsToMany(Cast::class, 'cast_season')->withPivot('order', 'star');
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'media_season');
    }
}

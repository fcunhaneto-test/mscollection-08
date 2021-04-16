<?php

namespace App\Models;

use App\Models\Cast\Cast;
use App\Models\Cast\Producer;
use App\Models\Qualifiers\Media;
use App\Models\Qualifiers\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title', 'original_title', 'year', 'time', 'category_1', 'category_2', 'category_3', 'our_rating',
        'imdb_rating', 'poster', 'summary', 'country', 'is_movie'
    ];

     public function producers()
     {
         return $this->belongsToMany(Producer::class)->withPivot('order');
     }

    public function cast()
    {
        return $this->belongsToMany(Cast::class, 'cast_title')->withPivot('order', 'star');
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'media_title');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_title');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'title_user')->withPivot('user_rating', 'comment');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
}

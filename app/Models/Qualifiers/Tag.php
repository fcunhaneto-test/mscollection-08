<?php

namespace App\Models\Qualifiers;

use App\Models\Title;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function titles()
    {
        return $this->belongsToMany(Title::class, 'tag_title');
    }
}

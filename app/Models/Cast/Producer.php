<?php

namespace App\Models\Cast;

use App\Models\Title;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function titles()
    {
        return $this->belongsToMany(Title::class)->withPivot('order');
    }
}

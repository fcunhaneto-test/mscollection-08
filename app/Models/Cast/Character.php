<?php

namespace App\Models\Cast;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}

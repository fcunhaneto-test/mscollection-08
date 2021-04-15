<?php

namespace App\Models\Cast;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}

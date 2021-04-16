<?php

namespace App\Models\Qualifiers;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    public $timestamps = false;
    protected $fillable = ['name', 'e_name'];
}

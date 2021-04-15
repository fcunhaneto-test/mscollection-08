<?php

namespace App\Http\Controllers\Qualifiers;

use App\Http\Controllers\Controller;
use App\Models\Qualifiers\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        return Media::all();
    }
}

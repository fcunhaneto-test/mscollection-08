<?php

namespace App\Http\Controllers;

use App\Models\Qualifiers\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TitleController extends Controller
{
    public function start($channel)
    {
        $index = 1;
        $view = 'titles';
        $url = url()->current();
        $url_path = parse_url($url, PHP_URL_PATH);
        $basename = explode('/', $url_path);

        if($basename[1] == 'admin') {
            $index = 2;
            $view = 'admin';
        }

        if($basename[$index] == 'filmes') {
            $header = 'Filmes';
        } else {
            $header = 'Séries';
        }

        if(Auth::user()) {
            if(Auth::user()->role == 'admin') {
                $media = Media::all();
                $subheader = $media->where('slug', $channel)->first()->name;
                return view($view, compact('header', 'subheader', 'media'));
            }
        }

        $c_media = new Media();
        $media = $c_media->streams();
        $subheader = $c_media->where('slug', $channel)->first()->name;

        return view('titles', compact('header', 'subheader', 'media'));
    }

}

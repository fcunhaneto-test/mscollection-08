<?php

namespace App\Http\Controllers;

use App\Models\Qualifiers\Media;
use App\Models\Title;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TitleController extends Controller
{
    public function start($channel)
    {
        $index = 1;
        $view = 'app';
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
                $c_media = new Media();
                $media = $c_media->where('active', true)->get();
                $subheader = $c_media->where('slug', $channel)->first()->name;
                return view($view, compact('header', 'subheader', 'media'));
            }
        }

        $c_media = new Media();
        $media = $c_media->streams();
        $subheader = $c_media->where('slug', $channel)->first()->name;

        return view('app', compact('header', 'subheader', 'media'));
    }

    public function titlesPage($channel, $page, $pp, $is_movie)
    {
        $c_media = new Media();
        $media = $c_media->where('slug', $channel)->first();
        $offset = ($page - 1) * $pp;
        $titles = $media->titles()
                    ->where('titles.is_movie', $is_movie)
                    ->orderBy('titles.title')
                    ->offset($offset)->limit($pp)->get();
        return $titles;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required_with|String',
            'year' => 'required',
        ]);

        $title = new Title();
        $exist = $title->where('title', '=', $request->title)->where('year', '=', $request->year)->count();
        if ($exist) {
            return response()->json('', 200);
        }

        $title->title = $request->title;
        $title->original_title = $request->original_title;
        $title->year = $request->year;
        $title->time = $request->time;
        $title->our_rating = $request->our_rating;
        $title->imdb_rating = $request->imdb_rating;
        $title->country = $request->country;
        $title->category_1 = $request->category_1;
        $title->category_2 = $request->category_2;
        $title->category_3 = $request->category_3;
        $title->poster = str_replace(' ', '', $request->title) . '-' . $request->year . '.jpg';
        $title->summary = $request->summary;
        $title->is_movie = $request->is_movie;

        $title->save();

        $media = json_decode($request->media);
        $title->media()->sync($media);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_URL, $request->img_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        Storage::disk('posters')->put($title->poster, $result);

        return response()->json($title->id, 201);
    }
}

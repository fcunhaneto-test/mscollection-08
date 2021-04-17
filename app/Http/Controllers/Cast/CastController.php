<?php

namespace App\Http\Controllers\Cast;

use App\Models\Cast\Actor;
use App\Models\Cast\Cast;
use App\Models\Cast\Character;
use App\Http\Controllers\Controller;
use App\Models\Title;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function castTitle($title_id)
    {
        $cast = new Cast();
        return $cast->castTitle($title_id);
    }

    public function store(Request $request)
    {
        $actor = Actor::firstOrCreate(['name' => $request->actor]);
        $character = Character::firstOrCreate(['name' => $request->character]);
        $cast = Cast::firstOrCreate(['actor_id' => $actor->id], ['character_id' => $character->id]);

        $cast->titles()->attach($request->title_id, ['order' => $request->order, 'star' => $request->star]);

        return response()->json($cast, 200);
    }
}

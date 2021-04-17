<?php

namespace App\Http\Controllers\Cast;

use App\Http\Controllers\Controller;
use App\Models\Cast\Producer;
use App\Models\Title;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function producerTitle($title_id)
    {
        $title = Title::findOrFail($title_id);
        return $title->producers;
    }

    public function store(Request $request)
    {
        $producer = Producer::firstOrCreate(['name' => $request->producer]);
        $producer->titles()->attach($request->title_id, ['order' => $request->order]);

        return response()->json('', 200);
    }
}

<?php

namespace App\Http\Controllers\Qualifiers;

use App\Http\Controllers\Controller;
use App\Models\Qualifiers\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected $table;

    public function __construct()
    {
        $this->table = new Media();
    }
    public function index()
    {
        return $this->table->where('active', true)->get();
    }
}

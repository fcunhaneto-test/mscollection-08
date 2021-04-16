<?php

namespace App\Http\Controllers\Qualifiers;

use App\Http\Controllers\Controller;
use App\Models\Qualifiers\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        return Country::all();
    }
}

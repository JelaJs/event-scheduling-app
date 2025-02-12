<?php

namespace App\Http\Controllers;

use App\Models\Bands;
use Illuminate\Http\Request;

class BandController extends Controller
{
    
    public function index() {

        $bands = Bands::all();

        return view('bands.all', ['bands' => $bands]);
    }

    public function find(Bands $band) {

        return view('bands.single', ['band' => $band]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bands;

class BandController extends Controller
{
    
    public function index() {

        return view('bands.all', ['bands' => Bands::all()]);
    }

    public function find(Bands $band) {

        return view('bands.single', ['band' => $band]);
    }
}

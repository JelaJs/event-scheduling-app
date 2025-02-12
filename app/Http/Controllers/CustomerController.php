<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeReservationRequest;
use App\Http\Requests\MakeResrvationRequest;
use App\Models\Bands;
use App\Models\Reservations;
use App\Models\Restaurants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    
    public function index() {

        $reservations = Reservations::where('customer_id', Auth::id())->get();
        $restaurants = Restaurants::all();
        $bands = Bands::all();

        return view('customer.index', [
            'reservations' => $reservations,
            'restaurants' => $restaurants,
            'bands' => $bands
        ]);
    }

    public function store(MakeReservationRequest $request) {

        dd('proso uslov');
    }
}

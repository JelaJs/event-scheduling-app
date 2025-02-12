<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeReservationRequest;
use App\Models\Bands;
use App\Models\Reservations;
use App\Models\Restaurants;
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

        $reservationExists = Reservations::firstWhere([
            ['reservation_date', $request->reservation_date]
        ]);

        if($reservationExists) return redirect()->back()->withErrors('You already have a reservation for the current date');

        Reservations::create([

            'restaurant_id' => $request->restaurant_id,
            'band_id' => $request->band_id,
            'customer_id' => Auth::id(),
            'reservation_date' => $request->reservation_date
        ]);

        return redirect()->back();
    }
}

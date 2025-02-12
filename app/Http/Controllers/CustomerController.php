<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeReservationRequest;
use App\Models\Bands;
use App\Models\Reservations;
use App\Models\Restaurants;
use App\Repositories\ReservationRepository;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    
    private $reservationRepo;
    public function __construct() {

        $this->reservationRepo = new ReservationRepository();
    }

    public function index() {

        Reservations::where('reservation_date', '<', date('Y-m-d'))->delete();

        $reservations = Reservations::with('user', 'restaurant', 'band')->where('customer_id', Auth::id())->get();
        $restaurants = Restaurants::all();
        $bands = Bands::all();

        return view('customer.index', [
            'reservations' => $reservations,
            'restaurants' => $restaurants,
            'bands' => $bands
        ]);
    }

    public function store(MakeReservationRequest $request) {

        if($this->reservationRepo->checkIfReservationExists($request)) return redirect()->back()->withErrors('You already have a reservation for the current date');

        $this->reservationRepo->store($request);

        return redirect()->back();
    }
}

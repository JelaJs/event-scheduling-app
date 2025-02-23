<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeReservationRequest;
use App\Models\Bands;
use App\Models\Reservations;
use App\Models\Restaurants;
use App\Repositories\ReservationRepository;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct(private ReservationRepository $reservationRepo, private ReservationService $reservationService) {

    }

    public function index() {

        $this->reservationService->deleteReservationIfExpired();

        $reservations = Reservations::with('user', 'restaurant', 'band')->where('customer_id', Auth::id())->get();

        return view('customer.index', [
            'reservations' => $reservations,
            'restaurants' => Restaurants::all(),
            'bands' => Bands::all(),
        ]);
    }

    public function store(MakeReservationRequest $request) {

        if($this->reservationRepo->checkIfReservationExists($request)) return redirect()->back()->withErrors('You already have a reservation for the current date');
        if($this->reservationRepo->checkIfRestaurantDateIsBusy($request)) return redirect()->back()->withErrors('Restaurant is busy for current date');
        if($this->reservationRepo->checkIfBandDateIsBusy($request)) return redirect()->back()->withErrors('Band is busy for current date.');
        
        $this->reservationRepo->store($request);
        return redirect()->back();
    }

    public function edit(Reservations $reservation) {

        return view('customer.edit', [
            'reservation' => $reservation,
            'restaurants' => Restaurants::all(),
            'bands' => Bands::all(),
        ]);
    }

    public function update(MakeReservationRequest $request, Reservations $reservation) {

        if(!$this->reservationRepo->checkIfStatusIsPending($reservation)) return redirect()->back()->withErrors("You can't make change at this point");
        if($this->reservationRepo->checkIfChangedReservationExists($request, $reservation)) return redirect()->back()->withErrors('You already have a reservation for the current date');
        if($this->reservationRepo->checkIfRestaurantDateIsBusy($request)) return redirect()->back()->withErrors('Restaurant is busy for current date');
        if($this->reservationRepo->checkIfBandDateIsBusy($request)) return redirect()->back()->withErrors('Band is busy for current date.');
        
        $this->reservationRepo->update($reservation, $request);
        return redirect()->route('customer.index');
    }

    public function delete(Reservations $reservation) {

        $reservation->delete();
        return redirect()->back();
    }
}

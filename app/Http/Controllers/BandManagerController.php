<?php

namespace App\Http\Controllers;

use App\Http\Requests\BandStoreAndUpdateRequest;
use App\Models\Bands;
use App\Models\Reservations;
use App\Repositories\BandManagerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BandManagerController extends Controller
{

    private $bandRepo;
    public function __construct() {

        $this->bandRepo = new BandManagerRepository();
    }

    public function index() {

        $band = Bands::firstWhere('user_id', Auth::id());
        return view('manager.band', ['band' => $band]);
    }

    public function store(BandStoreAndUpdateRequest $request) {

        if(Bands::firstWhere('user_id', Auth::id())) return redirect()->route('home');

        $bcgPath = $this->bandRepo->checkAndAssignBcgPath($request, 'bands');

        $imagePaths = [];
        $this->bandRepo->checkAndAssingImgPaths($request, $imagePaths, 'bands');

        $this->bandRepo->store($request, $bcgPath, $imagePaths);

        return redirect()->back();
    }

    public function edit(Bands $band) {

        if($band->user_id !== Auth::id()) return redirect()->back();

        return view('manager.editBand', ['band' => $band]);
    }

    public function update(BandStoreAndUpdateRequest $request, Bands $band) {

        if($band->user_id !== Auth::id()) return redirect()->back();

        $this->bandRepo->checkAndUpdateRestaurantBcg($request, $band, 'bands');

        $this->bandRepo->checkAndUpdateImgPaths($request, $band, 'bands');

        $this->bandRepo->fillAndSaveBand($request, $band);

        return redirect()->route('manager.band.index');
    }

    public function delete(Bands $band) {

        if($band->user_id !== Auth::id()) return redirect()->back();

        $band->delete();

        return redirect()->back();
    }

    public function updateReservationStatus(Reservations $reservation, $status) {

        if($reservation->band_status !== 'pending') return redirect()->back();

        if($status !== 'accepted' && $status !== 'rejected') return redirect()->back();

        $band = Bands::firstWhere('id', $reservation->band_id);
        if($band->user_id !== Auth::id()) return redirect()->back();

        $reservation->band_status = $status;
        $reservation->save();

        return redirect()->back();
    }
}

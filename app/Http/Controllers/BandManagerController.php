<?php

namespace App\Http\Controllers;

use App\Http\Requests\BandStoreAndUpdateRequest;
use App\Http\Requests\ValidateImage;
use App\Models\BandImages;
use App\Models\Bands;
use App\Models\Reservations;
use App\Repositories\BandManagerRepository;
use App\Services\BandService;
use Illuminate\Support\Facades\Auth;

class BandManagerController extends Controller
{
    public function __construct(private BandManagerRepository $bandRepo, private BandService $bandService) {

    }

    public function index() {
        
        return view('manager.band', ['band' => Bands::firstWhere('user_id', Auth::id())]);
    }

    public function store(BandStoreAndUpdateRequest $request) {

        if($this->bandService->checkIfUserAlreadyHaveBand()) return redirect()->route('home');

        $bcgPath = $this->bandService->checkAndAssignBcgPath($request, 'bands');

        $imagePaths = [];
        $this->bandService->checkAndAssignImgPaths($request, $imagePaths, 'bands');

        $this->bandRepo->store($request, $bcgPath, $imagePaths);
        return redirect()->back();
    }

    public function edit(Bands $band) {

        return view('manager.editBand', ['band' => $band]);
    }

    public function update(BandStoreAndUpdateRequest $request, Bands $band) {

        $this->bandRepo->checkAndUpdateRestaurantBcg($request, $band, 'bands');
        $this->bandRepo->fillAndSaveBand($request, $band);

        return redirect()->route('manager.band.index');
    }

    public function delete(Bands $band) {

        $band->delete();
        return redirect()->back();
    }

    public function updateReservationStatus(Reservations $reservation, $status) {

        if(!$this->bandService->checkIfRestaurantOrBandReservationIsPending($reservation->band_status)) return redirect()->back();

        if(!$this->bandService->checkIfPassedStatusIsCorrect($status)) return redirect()->back();

        $band = Bands::firstWhere('id', $reservation->band_id);
        if($band->user_id != Auth::id()) return redirect()->back();

        $reservation->band_status = $status;
        $reservation->save();

        return redirect()->back();
    }

    public function replace(ValidateImage $request, BandImages $image) {

        if(!$this->bandService->checkIfUserOwnsImage($image)) return redirect()->back();

        $this->bandRepo->checkAndReplaceImage($request, $image, 'bands');
        $image->save();
        return redirect()->back();
    }

    public function deleteImage(BandImages $image) {

        if(!$this->bandService->checkIfUserOwnsImage($image)) return redirect()->back();
        
        $image->delete();
        return redirect()->back();
    }

    public function addImage(ValidateImage $request, Bands $restaurant) {

        $imgPath = $this->bandService->checkAndAssignImgPath($request, 'bands');
        BandImages::create([

            'bands_id' => $restaurant->id,
            'image' => $imgPath,
            'user_id' => Auth::id()
        ]);

        return redirect()->back();
    }
}

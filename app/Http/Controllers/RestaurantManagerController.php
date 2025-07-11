<?php

namespace App\Http\Controllers;

use App\Helper\ReservationHelper;
use App\Http\Requests\RestorauntStoreRequest;
use App\Http\Requests\ValidateImage;
use App\Models\Reservations;
use App\Models\RestaurantImages;
use App\Models\Restaurants;
use App\Repositories\RestaurantManagerRepository;
use App\Services\RestaurantService;
use App\Traits\HandleUploads;
use Illuminate\Support\Facades\Auth;

class RestaurantManagerController extends Controller
{

    use HandleUploads;
    public function __construct(private RestaurantManagerRepository $restaurantRepo, private RestaurantService $restaurantService, private ReservationHelper $resrevation) {

    }
    
    public function index() {

        return view('manager.restaurant', 
        ['restaurant' => Restaurants::with(['reservations', 'images'])->firstWhere('user_id', Auth::id())]);
    }

    public function store(RestorauntStoreRequest $request) {

        if($this->restaurantService->checkIfUserAlreadyHaveRestaurant()) return redirect()->route('home');

        $bcgPath = $this->checkAndAssignBcgPath($request, 'restaurants');

        $imagePaths = [];
        $this->checkAndAssignImgPaths($request, $imagePaths, 'restaurants');

        $this->restaurantRepo->store($request, $bcgPath, $imagePaths);
        return redirect()->back();
    }

    public function edit(Restaurants $restaurant) {

        return view('manager.editRestaurant', ['restaurant' => $restaurant]);
    }

    public function update(RestorauntStoreRequest $request, Restaurants $restaurant) {

        $this->restaurantRepo->checkAndUpdateRestaurantBcg($request, $restaurant, 'restaurants');

        $this->restaurantRepo->fillAndSave($request, $restaurant);
        return redirect()->route('manager.restaurant.index');
    }

    public function delete(Restaurants $restaurant) {

        $restaurant->delete();
        return redirect()->back();
    }

    public function updateReservationStatus(Reservations $reservation, $status) {

        if(!$this->restaurantService->checkIfRestaurantOrBandReservationIsPending($reservation->restaurant_status)) return redirect()->back();

        if(!$this->resrevation->checkIfPassedStatusIsCorrect($status)) return redirect()->back();

        $restaurant = Restaurants::firstWhere('id', $reservation->restaurant_id);
        if($restaurant->user_id != Auth::id()) return redirect()->back();

        $reservation->restaurant_status = $status;
        $reservation->save();
        return redirect()->back();
    }

    public function replace(ValidateImage $request, RestaurantImages $image) {

        if(!$this->restaurantService->checkIfUserOwnsImage($image)) return redirect()->back();

        $this->restaurantRepo->checkAndReplaceImage($request, $image, 'restaurants');
        $image->save();
        return redirect()->back();
    }

    public function deleteImage(RestaurantImages $image) {

        if(!$this->restaurantService->checkIfUserOwnsImage($image)) return redirect()->back();
        
        $image->delete();
        return redirect()->back();
    }

    public function addImage(ValidateImage $request, Restaurants $restaurant) {

        $imgPath = $this->checkAndAssignImgPath($request, 'restauratns');
        RestaurantImages::create([

            'restaurants_id' => $restaurant->id,
            'image' => $imgPath,
            'user_id' => Auth::id()
        ]);

        return redirect()->back();
    }
}

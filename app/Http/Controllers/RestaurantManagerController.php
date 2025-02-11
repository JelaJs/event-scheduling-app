<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestorauntStoreRequest;
use App\Models\Restaurants;
use App\Repositories\RestaurantManagerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantManagerController extends Controller
{

    private $restaurantRepo;
    public function __construct() {

        $this->restaurantRepo = new RestaurantManagerRepository();
    }
    
    public function index() {

        $restaurant = Restaurants::firstWhere('user_id', Auth::id());

        return view('manager.restaurant', ['restaurant' => $restaurant]);
    }

    public function store(RestorauntStoreRequest $request) {

        if(Restaurants::firstWhere('user_id', Auth::id())) return redirect()->route('home');

        $bcgPath = $this->restaurantRepo->checkAndAssignBcgPath($request, 'restaurants');

        $imagePaths = [];
        $this->restaurantRepo->checkAndAssingImgPaths($request, $imagePaths, 'restaurants');

        $this->restaurantRepo->store($request, $bcgPath, $imagePaths);

        return redirect()->back();
    }

    public function edit(Restaurants $restaurant) {

        if($restaurant->user_id !== Auth::id()) return redirect()->back();

        return view('manager.editRestaurant', [
            'restaurant' => $restaurant
        ]);
    }

    public function update(RestorauntStoreRequest $request, Restaurants $restaurant) {

        if($restaurant->user_id !== Auth::id()) return redirect()->back();

        $this->restaurantRepo->checkAndUpdateRestaurantBcg($request, $restaurant, 'restaurants');

        $this->restaurantRepo->checkAndUpdateImgPaths($request, $restaurant, 'restaurants');

        $this->restaurantRepo->fillAndSave($request, $restaurant);

        return redirect()->route('manager.restaurant.index');
    }

    public function delete(Restaurants $restaurant) {

        if($restaurant->user_id !== Auth::id()) return redirect()->back();

        $restaurant->delete();

        return redirect()->back();
    }
}

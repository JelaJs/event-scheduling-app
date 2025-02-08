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

        if(Restaurants::firstWhere('user_id', Auth::id())) {
            return redirect()->route('home');
        }

        $bcgPath = null;
        if($request->hasFile('background_image')) {

            $bcgPath = $request->file('background_image')->store('uploads', 'public');
        }

        $imagePaths = [];
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('uploads', 'public');
                $imagePaths[] = $path;
            }
        }

        $this->restaurantRepo->store($request, $bcgPath, $imagePaths);

        return redirect()->back();
    }

    public function edit(Restaurants $restaurant) {

        if($restaurant->user_id !== Auth::id()) {

            return redirect()->back();
        }

        return view('manager.editRestaurant', [
            'restaurant' => $restaurant
        ]);
    }

    public function update(RestorauntStoreRequest $request, Restaurants $restaurant) {

        if($restaurant->user_id !== Auth::id()) {

            return redirect()->back();
        }

        if($request->hasFile('background_image')) {

            $restaurant->background_image = $request->file('background_image')->store('uploads', 'public');
        }

        if ($request->hasFile('images')) {
            $imagePaths = array_map(fn($image) => $image->store('uploads', 'public'), $request->file('images'));
    
            $restaurant->image_1 = $imagePaths[0] ?? $restaurant->image_1;
            $restaurant->image_2 = $imagePaths[1] ?? $restaurant->image_2;
            $restaurant->image_3 = $imagePaths[2] ?? $restaurant->image_3;
        }

        $restaurant->fill($request->only([
            'name', 'description', 'instagram', 'youtube', 'phone_number'
        ]));

        $restaurant->save();

        return redirect()->route('manager.restaurant.index');
    }
}

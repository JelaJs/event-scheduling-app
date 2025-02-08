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
}

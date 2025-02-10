<?php

namespace App\Http\Controllers;

use App\Models\Restaurants;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    
    public function index() {

        $restaurants = Restaurants::all();

        return view('restaurant.all', ['restaurants' => $restaurants]);
    }

    public function find(Restaurants $restaurant) {

        return view('restaurant.single', ['restaurant' => $restaurant]);
    }
}

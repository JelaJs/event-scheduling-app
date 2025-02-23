<?php

namespace App\Http\Controllers;

use App\Models\Restaurants;

class RestaurantController extends Controller
{
    
    public function index() {

        return view('restaurant.all', ['restaurants' => Restaurants::all()]);
    }

    public function find(Restaurants $restaurant) {

        return view('restaurant.single', ['restaurant' => $restaurant]);
    }
}

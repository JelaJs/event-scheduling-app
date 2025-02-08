<?php

namespace App\Repositories;

use App\Models\Restaurants;
use Illuminate\Support\Facades\Auth;

class RestaurantManagerRepository {

    private $restaurantModel;
    public function __construct() {

        $this->restaurantModel = new Restaurants();
    }

    public function store($request, $bcgPath, $imagePaths) {

        $this->restaurantModel->create([

            'user_id' => Auth::id(), 
            'name' => $request->name,
            'background_image' => $bcgPath,
            'image_1' => $imagePaths[0] ?? null,
            'image_2' => $imagePaths[1] ?? null,
            'image_3' => $imagePaths[3] ?? null,
            'description' => $request->description,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'phone_number' => $request->phone_number
        ]);
    }
}
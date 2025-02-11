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
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);
    }

    public function checkAndAssignBcgPath($request, $repo) {

        if($request->hasFile('background_image')) {

            return $request->file('background_image')->store("uploads/$repo", 'public');
        }

        return null;
    }

    public function checkAndAssingImgPaths($request, &$imagePaths, $repo) {

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store("uploads/$repo", 'public');
                $imagePaths[] = $path;
            }
        }
    }

    public function checkAndUpdateRestaurantBcg($request, $restaurant, $repo) {

        if($request->hasFile('background_image')) {

            $restaurant->background_image = $request->file('background_image')->store("uploads/$repo", 'public');
        }
    }

    public function checkAndUpdateImgPaths($request, $restaurant, $repo) {

        if ($request->hasFile('images')) {
            $imagePaths = array_map(fn($image) => $image->store("uploads/$repo", 'public'), $request->file('images'));
    
            $restaurant->image_1 = $imagePaths[0] ?? $restaurant->image_1;
            $restaurant->image_2 = $imagePaths[1] ?? $restaurant->image_2;
            $restaurant->image_3 = $imagePaths[2] ?? $restaurant->image_3;
        }
    }

    public function fillAndSave($request, $restaurant) {

        $restaurant->fill($request->only([
            'name', 'description', 'instagram', 'youtube', 'address', 'phone_number'
        ]));

        $restaurant->save();
    }
}
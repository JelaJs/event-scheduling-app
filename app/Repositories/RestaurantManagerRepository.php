<?php

namespace App\Repositories;

use App\Models\RestaurantImages;
use App\Models\Restaurants;
use Illuminate\Support\Facades\Auth;

class RestaurantManagerRepository {

    private $restaurantModel;
    private $resImagesModel;
    public function __construct() {

        $this->restaurantModel = new Restaurants();
        $this->resImagesModel = new RestaurantImages();
    }

    public function store($request, $bcgPath, $imagePaths) {

        $restaurant = $this->restaurantModel->create([

            'user_id' => Auth::id(), 
            'name' => $request->name,
            'background_image' => $bcgPath,
            'description' => $request->description,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);

        foreach($imagePaths as $imgPath) {
            
            $this->resImagesModel->create([
                'restaurants_id' => $restaurant->id,
                'image' => $imgPath,
            ]);
        }
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

    public function checkAndUpdateRestaurantBcg($request, $table, $repo) {

        if($request->hasFile('background_image')) {

            $table->background_image = $request->file('background_image')->store("uploads/$repo", 'public');
        }
    }

    public function checkAndUpdateImgPaths($request, $table, $repo) {

        if ($request->hasFile('images')) {
            $imagePaths = array_map(fn($image) => $image->store("uploads/$repo", 'public'), $request->file('images'));
    
            $table->image_1 = $imagePaths[0] ?? $table->image_1;
            $table->image_2 = $imagePaths[1] ?? $table->image_2;
            $table->image_3 = $imagePaths[2] ?? $table->image_3;
        }
    }

    public function fillAndSave($request, $restaurant) {

        $restaurant->fill($request->only([
            'name', 'description', 'instagram', 'youtube', 'address', 'phone_number'
        ]));

        $restaurant->save();
    }
}
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
                'user_id' => Auth::id()
            ]);
        }
    }

    public function checkAndUpdateRestaurantBcg($request, $tableRow, string $repo) {

        if($request->hasFile('background_image')) {
            $tableRow->background_image = $request->file('background_image')->store("uploads/$repo", 'public');
        }
    }

    public function fillAndSave($request, $restaurant) {

        $restaurant->fill($request->only([
            'name', 'description', 'instagram', 'youtube', 'address', 'phone_number'
        ]));

        $restaurant->save();
    }

    public function checkAndReplaceImage($request, $tableRow, string $repo): void {
        
        if($request->hasFile('image')) {
            $tableRow->image = $request->file('image')->store("uploads/$repo", 'public');
        }
    }

    
}
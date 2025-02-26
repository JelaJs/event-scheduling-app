<?php

namespace App\Services;

use App\Models\Reservations;
use App\Models\Restaurants;
use Illuminate\Support\Facades\Auth;

class RestaurantService {

    public function checkIfUserAlreadyHaveRestaurant(): bool {

        return (bool) Restaurants::firstWhere('user_id', Auth::id());
    }

    public function checkIfRestaurantOrBandReservationIsPending($reservationType): bool {

        return $reservationType === Reservations::PENDING_STATUS;
    }

    public function checkIfUserOwnsImage($image): bool {

        return $image->user_id == Auth::id();
    }

    public function checkAndAssignBcgPath($request, string $repo){
        
        return $request->hasFile('background_image') ? $request->file('background_image')->store("uploads/$repo", 'public') : null;
    }

    public function checkAndAssignImgPaths($request, array &$imagePaths, string $repo): void {

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store("uploads/$repo", 'public');
            }
        }
    }

    public function checkAndAssignImgPath($request, string $repo){

        return $request->hasFile('image') ? $request->file('image')->store("uploads/$repo", 'public') : null;
    }
}
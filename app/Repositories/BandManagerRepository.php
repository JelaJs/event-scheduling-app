<?php

namespace App\Repositories;

use App\Models\Bands;
use Illuminate\Support\Facades\Auth;

class BandManagerRepository extends RestaurantManagerRepository {

    private $bandModel;
    public function __construct() {

        parent::__construct();
        $this->bandModel = new Bands();
    }

    public function store($request, $bcgPath, $imagePaths) {

        $this->bandModel->create([

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
        ]);
    }

    public function fillAndSaveBand($request, $band) {

        $band->fill($request->only([
            'name', 'description', 'instagram', 'youtube', 'phone_number'
        ]));

        $band->save();
    }
}
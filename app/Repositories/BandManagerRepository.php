<?php

namespace App\Repositories;

use App\Models\BandImages;
use App\Models\Bands;
use Illuminate\Support\Facades\Auth;

class BandManagerRepository extends RestaurantManagerRepository {

    private $bandModel;
    private $bandImagesModel;
    public function __construct() {

        parent::__construct();
        $this->bandModel = new Bands();
        $this->bandImagesModel = new BandImages();
    }

    public function store($request, $bcgPath, $imagePaths) {

        $band = $this->bandModel->create([

            'user_id' => Auth::id(), 
            'name' => $request->name,
            'background_image' => $bcgPath,
            'description' => $request->description,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'phone_number' => $request->phone_number,
        ]);

        foreach($imagePaths as $imgPath) {
            
            $this->bandImagesModel->create([
                'bands_id' => $band->id,
                'image' => $imgPath,
                'user_id' => Auth::id()
            ]);
        }
    }

    public function fillAndSaveBand($request, $band) {

        $band->fill($request->only([
            'name', 'description', 'instagram', 'youtube', 'phone_number'
        ]));

        $band->save();
    }
}
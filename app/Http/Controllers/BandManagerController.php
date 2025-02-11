<?php

namespace App\Http\Controllers;

use App\Http\Requests\BandStoreAndUpdateRequest;
use App\Models\Bands;
use App\Repositories\BandManagerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BandManagerController extends Controller
{
    
    private $bandRepo;
    public function __construct() {

        $this->bandRepo = new BandManagerRepository();
    }

    public function index() {

        $band = Bands::firstWhere('user_id', Auth::id());
        return view('manager.band', ['band' => $band]);
    }

    public function store(BandStoreAndUpdateRequest $request) {

        if(Bands::firstWhere('user_id', Auth::id())) return redirect()->route('home');

        $bcgPath = $this->bandRepo->checkAndAssignBcgPath($request, 'bands');

        $imagePaths = [];
        $this->bandRepo->checkAndAssingImgPaths($request, $imagePaths, 'bands');

        $this->bandRepo->store($request, $bcgPath, $imagePaths);

        return redirect()->back();
    }
}

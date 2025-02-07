<?php

namespace App\Http\Controllers;

use App\Models\Restaurants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantManagerController extends Controller
{
    
    public function index() {

        $restaurant = Restaurants::firstWhere('user_id', Auth::id());

        return view('manager.restaurant', ['restaurant' => $restaurant]);
    }

    public function store(Request $request) {

        //sredi kod, ispisi podatke koje si upisao u bazu, napravi seeder da generise 10 restorana

        $request->validate([
            'name' => 'required|string|min:3|max:64',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images' => 'nullable|array|max:3',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string|max:500',
            'instagram' => ['nullable', 'string', 'max:256', 'regex:/^(https?:\/\/)?(www\.)?(instagram\.com)\/[A-Za-z0-9_.-]+\/?$/'],
            'youtube' => ['nullable', 'string', 'max:256', 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[A-Za-z0-9_-]{11}$/'],
            'phone_number' => 'nullable|string|max:64'
        ]);

        if(Restaurants::firstWhere('user_id', Auth::id())) {

            return redirect()->route('home');
        }

        $bcgPath = null;
        if($request->hasFile('background_image')) {

            $bcgPath = $request->file('background_image')->store('uploads', 'public');
        }

        $imagePaths = [];
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('uploads', 'public');
                $imagePaths[] = $path;
            }
        }

        Restaurants::create([
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

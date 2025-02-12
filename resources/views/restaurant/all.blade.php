@extends('layout.layout')

@section('content')
    @if (count($restaurants) > 0)
        <h1 class="text-3xl font-500 mb-6">Restaurants:</h1>
        <div class="flex flex-wrap gap-6">
            @foreach ($restaurants as $restaurant)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full sm:w-1/2 lg:w-1/3">
                    @if ($restaurant->image_1)
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $restaurant->image_1) }}" alt="">
                    @else
                        <img class="w-full h-48 object-cover" src="storage/uploads/restaurants/default.jpg" alt="">
                    @endif
                    <div class="p-4">
                        <p class="text-xl font-semibold text-gray-800">{{$restaurant->name}}</p>
                        <p class="text-gray-600">{{$restaurant->number}}</p>
                        <a href="{{route('restaurants.single', $restaurant->id)}}" class="block text-blue-600 hover:underline mt-4">See More</a>
                    </div>
                </div>
            @endforeach
        </div>        
    @else
        <p>No restaurants...</p>
    @endif
@endsection
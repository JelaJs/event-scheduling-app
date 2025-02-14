@extends('layout.layout')

@section('content')
    <h1 class="text-3xl font-500 mb-6">Bands:</h1>
    @if (count($bands) > 0)
        <div class="flex flex-wrap gap-6">
            @foreach ($bands as $band)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full sm:w-1/2 lg:w-1/3">
                    @if ($band->background_image)
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $band->background_image) }}" alt="">
                    @else
                        <img class="w-full h-48 object-cover" src="storage/uploads/restaurants/default.jpg" alt="">
                    @endif
                    <div class="p-4">
                        <p class="text-xl font-semibold text-gray-800">{{$band->name}}</p>
                        <p class="text-gray-600">{{$band->number}}</p>
                        <a href="{{route('bands.single', $band->id)}}" class="block text-blue-600 hover:underline mt-4">See More</a>
                    </div>
                </div>
            @endforeach
        </div>        
    @else
        <p>No Bands...</p>
    @endif
@endsection
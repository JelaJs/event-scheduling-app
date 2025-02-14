@extends('layout.layout')

@section('content')
<div class="relative w-full h-[500px] bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $restaurant->background_image) }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    
    <!-- Info Content -->
    <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-6">
        <h1 class="text-3xl font-bold mb-2">{{ $restaurant->name }}</h1>
        <p class="max-w-xl mb-4">{{ $restaurant->description }}</p>
        <div class="flex space-x-4">
            <a target="_blank" href="{{ $restaurant->instagram }}" 
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md">Instagram</a>
            <a target="_blank" href="{{ $restaurant->youtube }}" 
                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg shadow-md">YouTube</a>
        </div>
        <p class="mt-4 font-semibold">Phone Number: {{ $restaurant->phone_number }}</p>
        <p class="mt-4 font-semibold">Address: {{ $restaurant->address }}</p>
    </div>
</div>

<!-- Restaurant Images Section -->
<div class="flex flex-wrap justify-center gap-6 mt-6 px-4">
    @foreach ($restaurant->images as $image)
        <img src="{{ asset('storage/' . $image->image) }}" 
             alt="Restaurant Image" 
             class="w-64 h-64 object-cover rounded-xl shadow-lg border border-gray-300 hover:scale-105 transition duration-300">
    @endforeach
</div>


<div class="bg-white p-6 rounded-lg shadow-md my-10">
    <p class="text-lg font-semibold text-gray-800 mb-3">Reserved Dates:</p>
    
    @foreach ($restaurant->reservations as $reservation)
        @if ($reservation->restaurant_status === 'accepted')
            <p class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg mb-2">
                {{ $reservation->reservation_date }}
            </p>
        @endif
    @endforeach
</div>
@endsection
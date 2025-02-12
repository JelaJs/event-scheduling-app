@extends('layout.layout')

@section('content')
    <form action="{{route('customer.store')}}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md space-y-4">
        
        @if ($errors->any())
            <p>{{$errors->first()}}</p>
        @endif
        
        @csrf
        <h2 class="text-2xl font-semibold text-gray-800 text-center">Make a Reservation</h2>
    
        <div>
            <label class="block text-sm font-medium text-gray-700">Restaurant</label>
            <select name="restaurant" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>                
                @endforeach
            </select>
        </div>
    
        <!-- Band Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Band</label>
            <select name="band" 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($bands as $band)
                    <option value="{{ $band->id }}">{{ $band->name }}</option>                
                @endforeach
            </select>
        </div>
    
        <!-- Reservation Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Reservation Date</label>
            <input type="date" name="reservation_date" min="{{ now()->toDateString() }}"
                   class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
    
        <!-- Submit Button -->
        <button type="submit" 
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
            Make Reservation
        </button>
    </form>

    @if (count($reservations) > 0)
        <p>Your Reservations</p>
    @endif
@endsection
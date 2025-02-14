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
        <a href="{{route('manager.restaurant.edit', $restaurant->id)}}" 
            class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg shadow-md my-4">Edit Restaurant</a>
    </div>
</div>

<!-- Restaurant Images Section -->
<div class="flex flex-wrap justify-center gap-6 mt-6 px-4">
    @foreach ($restaurant->images as $image)
     <div class="bg-white p-4 rounded-lg shadow-lg w-64">
         <img src="{{ asset('storage/' . $image->image) }}" 
              alt="Restaurant Image" 
              class="w-full h-40 rounded-lg object-cover">
 
         <div class="mt-4 flex justify-between gap-2">
             <form action="">
                 <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                     Update
                 </button>
             </form>
             <form>
                 <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                     Delete
                 </button>
             </form>
         </div>
     </div>
    @endforeach
 </div>

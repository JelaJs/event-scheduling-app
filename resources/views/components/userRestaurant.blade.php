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
        <a target="_blank" href="#" 
            class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg shadow-md my-4">Edit Restaurant</a>
    </div>
</div>

<!-- Restaurant Images Section -->
<div class="flex justify-center gap-4 mt-6 px-4">
    <img src="{{ asset('storage/' . $restaurant->image_1) }}" alt="" class="w-1/3 rounded-lg shadow-md object-cover">
    <img src="{{ asset('storage/' . $restaurant->image_2) }}" alt="" class="w-1/3 rounded-lg shadow-md object-cover">
    <img src="{{ asset('storage/' . $restaurant->image_3) }}" alt="" class="w-1/3 rounded-lg shadow-md object-cover">
</div>
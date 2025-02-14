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
    <div class="bg-white p-4 rounded-xl shadow-md w-72 border border-gray-200">
        <img src="{{ asset('storage/' . $image->image) }}" 
            alt="Restaurant Image" 
            class="w-full h-44 rounded-lg object-cover shadow-sm">

        <div class="mt-4 space-y-3">
            <form action="{{ route('manager.restaurant.replace', $image->id) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                @csrf
                @method('PATCH')

                <input 
                    type="file" 
                    name="image"
                    class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-white file:bg-blue-500 hover:file:bg-blue-600 transition"
                >

                <button class="w-full px-4 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 transition duration-200">
                    Replace
                </button>
            </form>

            <form action="{{ route('manager.restaurant.delete', $image->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="w-full px-4 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition duration-200">
                    Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

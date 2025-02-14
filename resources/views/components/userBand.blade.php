<div class="relative w-full h-[500px] bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $band->background_image) }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    
    <!-- Info Content -->
    <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-6">
        <h1 class="text-3xl font-bold mb-2">{{ $band->name }}</h1>
        <p class="max-w-xl mb-4">{{ $band->description }}</p>
        <div class="flex space-x-4">
            <a target="_blank" href="{{ $band->instagram }}" 
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md">Instagram</a>
            <a target="_blank" href="{{ $band->youtube }}" 
                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg shadow-md">YouTube</a>
        </div>
        <p class="mt-4 font-semibold">Phone Number: {{ $band->phone_number }}</p>
        <a href="{{route('manager.band.edit', $band->id)}}" 
            class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg shadow-md my-4">Edit Band</a>
    </div>
</div>

<!-- Restaurant Images Section -->
<div class="flex flex-wrap justify-center gap-6 mt-6 px-4">
    @foreach ($band->images as $image)
    <div class="bg-white p-4 rounded-xl shadow-md w-72 border border-gray-200">
        <img src="{{ asset('storage/' . $image->image) }}" 
            alt="Band Image" 
            class="w-full h-44 rounded-lg object-cover shadow-sm">

        <div class="mt-4 space-y-3">
            <form action="{{ route('manager.band.replace', $image->id) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
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

            <form action="{{ route('manager.band.deleteImage', $image->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="{{$image->id}}">
                <button class="w-full px-4 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition duration-200">
                    Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
    <form action="{{ route('manager.band.addImage', $band->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md border border-gray-200 w-full max-w-md">
        @csrf
    
        <label class="block text-gray-700 font-medium mb-2">Upload Image</label>
        <input 
            type="file" 
            name="image"
            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-white file:bg-blue-500 hover:file:bg-blue-600 transition"
        >
    
        <button type="submit" class="mt-4 w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
            Add Image
        </button>
    </form>
</div>
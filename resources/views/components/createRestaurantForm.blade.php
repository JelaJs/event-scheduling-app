<form class="bg-white shadow-md rounded-lg p-6 space-y-6 max-w-lg my-3" method="POST" action="{{ route('manager.restaurant.store') }}" enctype="multipart/form-data">
    @if ($errors->any())
        <p>Error: {{ $errors->first() }}</p>
    @endif
    
    @csrf

    <div>
        <label class="block text-gray-700 font-medium mb-2">Name *</label>
        <input 
            type="text" 
            name="name"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3"
            placeholder="Restaurant name"
            required>
    </div>
    <div>
        <label class="block text-gray-700 font-medium mb-2">Background Image</label>
        <input 
            type="file" 
            name="background_image" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm cursor-pointer bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-white file:bg-blue-500 hover:file:bg-blue-600"
        >
    </div>
    <div>
        <label class="block text-gray-700 font-medium mb-2">Restourant Images</label>
        <input 
            type="file" 
            name="images[]" 
            multiple
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm cursor-pointer bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-white file:bg-blue-500 hover:file:bg-blue-600"
        >
    </div>
    <div>
        <label class="block text-gray-700 font-medium mb-2">Description *</label>
        <input 
            type="text" 
            name="description"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3"
            placeholder="Description"
            required>
    </div>
    <div>
        <label class="block text-gray-700 font-medium mb-2">Instagram Link</label>
        <input 
            type="text" 
            name="instagram"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3"
            placeholder="Instagram link"
        >
    </div>
    <div>
        <label class="block text-gray-700 font-medium mb-2">Youtube Link</label>
        <input 
            type="text" 
            name="youtube"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3"
            placeholder="youtube link"
        >
    </div>
    <div>
        <label class="block text-gray-700 font-medium mb-2">Address *</label>
        <input 
            type="text" 
            name="address"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3"
            placeholder="Address"
            required>
    </div>
    <div>
        <label class="block text-gray-700 font-medium mb-2">Phone Number *</label>
        <input 
            type="text" 
            name="phone_number"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3"
            placeholder="Description"
            required>
    </div>

    <div>
        <button type="submit" class="px-6 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600">
            Create Restaurant
        </button>
    </div>
</form>
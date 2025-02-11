<form class="my-5" action="{{route('manager.band.delete', $band->id)}}" method="POST">

    @csrf

    <input type="hidden" name="_method" value="delete">
    <button class="text-red-600 text-lg font-semibold hover:text-red-800 focus:outline-none transition">
        Delete
    </button>
</form>
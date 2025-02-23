@php
    $status = new App\Helper\Status();
@endphp

<table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden my-10">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="px-6 py-3 text-left">Customer</th>
            <th class="px-6 py-3 text-left">Restaurant</th>
            <th class="px-6 py-3 text-left">Band</th>
            <th class="px-6 py-3 text-left">Date</th>
            <th class="px-6 py-3 text-left">Band Status</th>
            <th class="px-6 py-3 text-left">Restaurant Status</th>
            <th class="px-6 py-3 text-center">Accept</th>
            <th class="px-6 py-3 text-center">Reject</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($band->reservations as $reservation)
            <tr class="border-b hover:bg-gray-100">
                <td class="px-6 py-4">{{$reservation->user->name}}</td>
                <td class="px-6 py-4">{{$reservation->restaurant->name}}</td>
                <td class="px-6 py-4">{{$band->name}}</td>
                <td class="px-6 py-4">{{$reservation->reservation_date}}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-sm font-medium rounded-full {{$reservation->band_status == $status->pending() ? 'text-yellow-800 bg-yellow-200' : ' text-green-800 bg-green-200'}}">{{$reservation->band_status}}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-sm font-medium rounded-full {{$reservation->restaurant_status == $status->pending() ? 'text-yellow-800 bg-yellow-200' : ' text-green-800 bg-green-200'}}">{{$reservation->restaurant_status}}</span>
                </td>
                <td class="px-6 py-4 text-center">
                    @if($reservation->band_status == $status->pending())
                        <a href="{{route('manager.band.status', [$reservation->id, $status->approved()], )}}" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Accept</a>
                    @endif

                    @if($reservation->band_status == $status->approved())
                        <p>Accepted</p>
                    @endif
                </td>
                <td class="px-6 py-4 text-center">
                    @if($reservation->band_status == $status->pending()')
                        <a href="{{route('manager.band.status', [$reservation->id, $status->rejected()], )}}" class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">Reject</a>
                    @endif

                    @if($reservation->band_status == $status->rejected())
                        <p>Rejected</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
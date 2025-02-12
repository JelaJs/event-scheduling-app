@extends('layout.layout')

@section('content')

    @include('components.makeReservationForm')

    @if (count($reservations) > 0)
        <p>Your Reservations</p>
    @endif
@endsection
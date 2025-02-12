@extends('layout.layout')

@section('content')

    @include('components.makeReservationForm')

    @if (count($reservations) > 0)
        @include('components.customerReservationsTable')
    @endif
@endsection
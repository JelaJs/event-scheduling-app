@extends('layout.layout')

@section('content')
    @if (! $restaurant)
        @include('components.createRestaurantForm')
    @endif

    @if ($restaurant)
        @include('components.userRestaurant')

        @include('components.listRestaurantReservations')

        @include('components.deleteRestaurantForm')
    @endif
@endsection
@extends('layout.layout')

@section('content')
    @if (! $restaurant)
        @include('components.createRestaurantForm')
    @endif
@endsection
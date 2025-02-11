@extends('layout.layout')

@section('content')
    @if(! $band)
        @include('components.createBandForm')
    @endif

    @if ($band)
        @include('components.userBand')
    @endif
@endsection
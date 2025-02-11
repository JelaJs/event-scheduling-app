@extends('layout.layout')

@section('content')
    @if(! $band)
        @include('components.createBandForm')
    @endif

    @if ($band)
        
    @endif
@endsection
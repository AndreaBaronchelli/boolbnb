@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Apartment detail</h1>

        <h3>{{ $apartment->title }}</h3>

        @if ($apartment->image)
            <img width="200" src="{{ asset('storage/' . $apartment->image) }}" />
        @endif

        <div>Address: {{ $apartment->address }}</div>

        <div>Rooms: {{ $apartment->rooms }}</div>
        
        <div>Beds available: {{ $apartment->beds }}</div>

        <div>Bathrooms: {{ $apartment->bathrooms }}</div>

        <div>Square meters: {{ $apartment->square_meters }}</div>

        <div>Price per night: {{ $apartment->price }}</div>
        
        @if ($apartment->visibility == 1)
            <div>Visibility: {{ 'Public' }}</div>
            @else
            <div>Visibility: {{ 'Private' }}</div>
        @endif

    </div>
@endsection
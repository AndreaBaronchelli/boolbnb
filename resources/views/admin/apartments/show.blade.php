@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('admin.apartments.index') }}"> <-- Back to apartments list</a>

        <h1>Apartment detail</h1>
        
        @if (count($apartment->services) > 0)
            @foreach($apartment->services as $service)
                <span class="badge badge-primary">{{$service->name}}</span>
            @endforeach
        @endif

        <div><a class="btn btn-warning mb-3" href="{{ route('admin.apartments.edit', $apartment->id) }}">EDIT</a></div>

        <h3>{{ $apartment->title }}</h3>

        @if ($apartment->image)
            <img width="200" src="{{ asset('storage/' . $apartment->image) }}" />
        @endif

        <div>Address: {{ $apartment->address }}</div>

        <div>Rooms: {{ $apartment->rooms }}</div>
        
        <div>Beds available: {{ $apartment->beds }}</div>

        <div>Bathrooms: {{ $apartment->bathrooms }}</div>

        <div>Square meters: {{ $apartment->square_meters }} sqm</div>

        <div>Price per night: {{ $apartment->price }} €</div>

        <div>Visibility: {{ $apartment->visibility ? 'Public' : 'Private' }}</div>

    </div>
@endsection
@extends('layouts.app')

@section('content')
    @if (session('sponsored'))
        <div class="alert alert-success mt-3">
            {{ session('sponsored') }} is now sponsored!
        </div>
    @endif
    <div class="container">
        <a href="{{ route('admin.apartments.index') }}"> <-- Back to apartments list</a>
        <h1 class="text-secondary">{{$apartment->title}}</h1>
        <div><a class="btn btn-warning mb-3" href="{{ route('admin.apartments.edit', $apartment->id) }}">EDIT</a></div>
        <div class="row mt-4 mb-4">
            @if ($apartment->image)
                <div class="col-md-4">
                    <img class="img-fluid" src="{{ asset('storage/' . $apartment->image) }}" />
                </div>
            @endif
            <div class="col-md-8">
                
            @if (count($apartment->services) > 0)
                @foreach($apartment->services as $service)
                    <span class="badge badge-primary">{{$service->name}}</span>
                @endforeach
            @endif
            <h3>{{ $apartment->title }}</h3>

        
            <div><strong>Address: </strong>{{ $apartment->address }}</div>

            <div><strong>Rooms: </strong>{{ $apartment->rooms }}</div>
        
            <div><strong>Beds available: </strong>{{ $apartment->beds }}</div>

            <div><strong>Bathrooms: </strong>{{ $apartment->bathrooms }}</div>

            <div><strong>Square meters: </strong>{{ $apartment->square_meters }} sqm</div>

            <div><strong>Price per night: </strong>{{ $apartment->price }} €</div>

            <div><strong>Visibility: </strong>{{ $apartment->visibility ? 'Public' : 'Private' }}</div>


            </div>
        </div>

    </div>
@endsection
@extends('layouts.app')

@section('content')
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

        {{-- chart --}}
        <canvas id="myChart" width="400" height="400"></canvas>


    </div>

    <script>
        let myChart = document.getElementById('myChart').getContext('2d');

        let dataChart = new Chart(myChart, {
            type: 'bar',
            data: {
                labels: ['1', '2', '3',],
                datasets: {
                    label: ['pop'],
                    data: [
                        10,
                        20,
                        25
                    ]
                }
            },
            options: {

            }
        });

    </script>
@endsection
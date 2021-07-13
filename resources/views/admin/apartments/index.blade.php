@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('admin.home') }}"> <-- Back to Dashboard</a>

        <h1>My apartments</h1>

        <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary">CREATE A NEW APARTMENT</a>

        <table class="table mt-4">
            <thead>
                <tr>
                    {{-- <td>Image</td> --}}
                    <td>Title</td>
                    <td>Address</td>
                    <td>Price</td>
                    <td>Visibility</td>
                    <td colspan="3">Actions</td>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        {{-- <td>  --}}
                            {{-- <img width="200" src="{{ asset(‘storage/‘ . $apartment->apartments_image) }}" /> --}}
                        {{-- </td> --}}
                        <td> {{ $apartment->title }} </td>
                        <td> {{ $apartment->address }} </td>
                        <td> {{ $apartment->price }} </td>
                        @if ($apartment->visibility == 1)
                            <td>{{ 'Public' }}</td>
                            @else
                            <td>{{ 'Private' }}</td>
                        @endif

                        <td> <a class="btn btn-primary" href="{{ route('admin.apartments.show', $apartment->id) }}">Show</a> </td>
                        <td> <a class="btn btn-warning" href="{{ route('admin.apartments.edit', $apartment->id) }}">Edit</a> </td>
                        <td> <a class="btn btn-danger" href="#">Delete</a> </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- @foreach ($apartments as $apartment )
            <h3>{{ $apartment->title }}</h3>
        @endforeach --}}
    </div>
    
@endsection
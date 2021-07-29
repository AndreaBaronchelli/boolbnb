@extends('layouts.app')

@section('content')
    <div class="container pt-4">

        @if (session('deleted'))
            <div class="alert alert-success mt-3">
                {{ session('deleted') }} deleted successfully!
            </div>
        @endif


        <a href="{{ route('admin.home') }}"> <-- Back to Dashboard</a>

        <header class="d-flex justify-content-between align-items-center ">

            <h1 class="py-4">My apartments</h1>
    
            <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary  ">CREATE A NEW APARTMENT</a>

        </header>

        <table class="table mt-4 table-striped">
            <thead>
                <tr>
                    <td>Title</td>
                    <td>Address</td>
                    <td>Price</td>
                    <td>Visibility</td>
                    <td colspan="3">Actions</td>
                    
                </tr>
            </thead>
            <tbody >
                @foreach ($apartments as $apartment)
                    <tr>
                        <td> {{ $apartment->title }} </td>
                        <td> {{ $apartment->address }} </td>
                        <td> {{ $apartment->price }} €</td>
                        <td
                            @if (!$apartment->visibility) 
                                class="text-danger text-uppercase font-weight-bold"
                            @else
                                class="text-success text-uppercase font-weight-bold"
                            @endif

                        >{{ $apartment->visibility ? 'Public' : 'Private' }}</td>

                        <td> <a class="btn btn-primary" href="{{ route('admin.apartments.show', $apartment->id) }}">Show</a> </td>
                        <td> <a class="btn btn-primary" href="{{ route('admin.apartments.edit', $apartment->id) }}">Edit</a> </td>
                        <td><a class="btn btn-primary" href="{{route('admin.sponsorships.edit', $apartment->id)}}">Sponsorhip</a></td>
                        <td>
                            <form class="delete-post-form" action="{{route('admin.apartments.destroy', $apartment->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>

                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection
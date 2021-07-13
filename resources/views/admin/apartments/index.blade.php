@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('deleted'))
            <div class="alert alert-success mt-3">
                {{ session('deleted') }} deleted successfully!
            </div>
        @endif


        <a href="{{ route('admin.home') }}"> <-- Back to Dashboard</a>

        <h1>My apartments</h1>

        <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary">CREATE A NEW APARTMENT</a>

        <table class="table mt-4">
            <thead>
                <tr>
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
                        <td> {{ $apartment->title }} </td>
                        <td> {{ $apartment->address }} </td>
                        <td> {{ $apartment->price }} </td>
                        <td>{{ $apartment->visibility ? 'Public' : 'Private' }}</td>

                        <td> <a class="btn btn-primary" href="{{ route('admin.apartments.show', $apartment->id) }}">Show</a> </td>
                        <td> <a class="btn btn-warning" href="{{ route('admin.apartments.edit', $apartment->id) }}">Edit</a> </td>
                        <td>
                            <form action="{{route('admin.apartments.destroy', $apartment->id)}}" method="post">
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
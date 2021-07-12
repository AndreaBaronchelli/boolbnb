@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary">CREATE A NEW APARTMENT</a>
        <h1>index</h1>
        @foreach ($apartments as $apartment )
            <h3>{{ $apartment->title }}</h3>
        @endforeach
    </div>
    
@endsection
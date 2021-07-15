@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column align-items-center">
    <h2 class="text-center">Hello {{ $user->first_name }}!</h2>
    <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary my-4">CREATE A NEW APARTMENT</a>
    <nav class="align-self-stretch">
        <ul class="list-group">
            <li class="list-group-item list-group-item-action"><a href="{{ route('admin.apartments.index') }}" class="font-weight-bold">GO TO YOUR APARTMENTS</a></li>
            <li class="list-group-item list-group-item-action"><a href="#" class="font-weight-bold">GO TO YOUR MESSAGES</a></li>
            <li class="list-group-item list-group-item-action"><a href="#" class="font-weight-bold">GO TO YOUR STATISTIC</a></li>
            <li class="list-group-item list-group-item-action"><a href="{{ route('admin.sponsors.index') }}" class="font-weight-bold">GO TO YOUR SPONSORSHIPS</a></li>
        </ul>
    </nav>
    
    
    
</div>
@endsection

@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>messages</h1>

        <table class="table mt-4 table-striped">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Apartment</td>
                    <td>N. guests</td>
                    <td colspan="2">Message</td>
                </tr>
            </thead>
            <tbody >
                @foreach ($messages as $message)
                    <tr>
                        <td> {{ $message->name }} </td>
                        <td> {{ $message->email }} </td>
                        <td> {{ $message->phone_number }} </td>
                        <td> 
                            @foreach ($user_apartments as $apartment)
                                @if ($message->apartment_id === $apartment->id)
                                {{ 
                                    $apartment->title
                                }} 
                                @endif
                             @endforeach
                        </td>
                        <td> {{ $message->num_guests }} </td>
                        <td colspan="2">{{ $message->message }}</td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        
    
@endsection
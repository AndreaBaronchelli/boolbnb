@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table mt-4 table-striped">
            <thead>
                <tr>
                    <td>Title</td>
                    <td>Address</td>
                    <td>Visibility</td>
                    <td colspan="3">Sponsors</td>
                    
                </tr>
            </thead>
            <tbody >
                @foreach ($apartments as $apartment)
                    <tr>
                        <form action="{{route('admin.sponsor.pay', $apartment->id)}}" method="post">
                            @csrf
                            @method('POST')
                            <td id="apartment" name="apartment" value="{{$apartment->title}}"> {{ $apartment->title }} </td>
                            <td> {{ $apartment->address }} </td>
                            <td>{{ $apartment->visibility ? 'Public' : 'Private' }}</td>
                            <td>
                                <select name="sponsors" id="sponsors">
                                    @foreach ($sponsors as $sponsor)
                                        <option value="{{ $sponsor->id }}">
                                            {{ $sponsor->name }} | {{ $sponsor->duration }}hours | {{ $sponsor->price }}€
                                        </option>
                                    @endforeach
                                </select>

                                <input type="submit" class="btn btn-primary" value="SUBMIT">
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('admin.apartments.store') }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('POST')
            
            <div class="mb-3">
                <label for="title" class="form-label">Title*</label> 
                <input type="text" id="title" name="title" placeholder="Title Here..." class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms Number*</label> 
                <input type="number" id="rooms" name="rooms" placeholder="Rooms Number Here..." class="form-control @error('rooms') is-invalid @enderror" value="{{ old('rooms') }}">
                @error('rooms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">Beds Number</label> 
                <input type="number" id="beds" name="beds" placeholder="Beds Number Here..." class="form-control @error('beds') is-invalid @enderror" value="{{ old('beds') }}">
                @error('beds')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms Number</label> 
                <input type="number" id="bathrooms" name="bathrooms" placeholder="Bathrooms Number Here..." class="form-control @error('bathrooms') is-invalid @enderror" value="{{ old('bathrooms') }}">
                @error('bathrooms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">Square Meters*</label> 
                <input type="number" id="square_meters" name="square_meters" placeholder="Square Meters Here..." class="form-control @error('square_meters') is-invalid @enderror" value="{{ old('square_meters') }}">
                @error('square_meters')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address*</label> 
                <input type="text" id="address" name="address" placeholder="Address Here..." class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror              
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label> 
                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                @foreach ($services as $service)
                    <span class="mr-2 d-inline-block">
                        <input 
                        type="checkbox" id="type{{$loop->iteration}}" name="services[]" 
                        value="{{$service->id}}"
                        @if (in_array($service->id, old('services', []))) 
                            checked
                        @endif>
                        <label for="type{{$loop->iteration}}">{{$service->name}}</label>
                    </span>
                @endforeach
            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">Price per Night*</label> 
                <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="visibility" class="form-label">The apartment is public?</label> 
                <select name="visibility" id="visibility">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button type="submit" class='btn btn-primary'>SUBMIT</button>
        </form>
    </div>
@endsection
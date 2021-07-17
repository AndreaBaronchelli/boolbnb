@extends('layouts.app')

@section('head')
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css'>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-secondary">Edit {{$apartment->title}}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                    <li class="list-group-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.apartments.update', $apartment->id) }}" method="post" class="form form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="mb-3">
                <label for="title" class="form-label">Title*</label> 
                <input type="text" id="title" name="title" placeholder="Title Here..." class="form-control @error('title') is-invalid @enderror" value="{{ $apartment->title }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms Number*</label> 
                <input type="number" id="rooms" name="rooms" placeholder="Rooms Number Here..." class="form-control @error('rooms') is-invalid @enderror" value="{{ $apartment->rooms }}">
                @error('rooms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">Beds Number</label> 
                <input type="number" id="beds" name="beds" placeholder="Beds Number Here..." class="form-control @error('beds') is-invalid @enderror" value="{{ $apartment->beds }}">
                @error('beds')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms Number</label> 
                <input type="number" id="bathrooms" name="bathrooms" placeholder="Bathrooms Number Here..." class="form-control @error('bathrooms') is-invalid @enderror" value="{{ $apartment->bathrooms }}">
                @error('bathrooms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">Square Meters*</label> 
                <input type="number" id="square_meters" name="square_meters" placeholder="Square Meters Here..." class="form-control @error('square_meters') is-invalid @enderror" value="{{ $apartment->square_meters }}">
                @error('square_meters')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3" id="searchbox">
                <label for="address" class="form-label">Address*</label> 
                <input type="text" id="address" name="address" placeholder="Address Here..." class="d-none form-control @error('address') is-invalid @enderror" value="{{ $apartment->address }}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Apartment image</label>
                <div class="mb-3">
                    @if ($apartment->image)
                        <img width="200" src="{{ asset('storage/' . $apartment->image) }}" alt="{{$apartment->title}}"> 
                    @endif
                </div>
                
                <div>
                    <input type="file" name="image" id="image">
                </div>
                @error('image')
                    <h4 class="mt-3">{{$message}}</h4>
                @enderror
                
            </div>

            <div class="mb-3">
                @foreach ($services as $service)
                    <span class="mr-2 d-inline-block">
                        <input 
                        type="checkbox" id="service{{$loop->iteration}}" name="services[]" 
                        value="{{$service->id}}"
                        @if ($errors->any() && in_array($service->id, old('services'))) 
                            checked
                        @elseif (! $errors->any() && $apartment->services->contains($service->id))
                            checked
                        @endif>
                        <label for="type{{$loop->iteration}}">{{$service->name}}</label>
                    </span>
                @endforeach

            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">Price per Night*</label> 
                <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $apartment->price) }}">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="visibility" class="form-label">The apartment is public?</label> 
                <select name="visibility" id="visibility">
                    <option @if($apartment->visibility == 1) selected @endif value="1">Yes</option>
                    <option @if($apartment->visibility == 0) selected @endif value="0">No</option>
                </select>
            </div>

            <button type="submit" class='btn btn-primary'>SUBMIT</button>
        </form>
    </div>

    <script>
        var options = {
            searchOptions: {
                key: 'HWJIfN6faq5SWzGHD4GKXdsexiZdkTDa',
                language: 'en-GB',
                limit: 5
            },
            autocompleteOptions: {
                key: 'HWJIfN6faq5SWzGHD4GKXdsexiZdkTDa',
                language: 'en-GB'
            }
        };
        var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
        var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
        
        document.getElementById('searchbox').appendChild(searchBoxHTML);

        document.getElementById('searchbox').addEventListener('focusout', function(e) {
            
        document.getElementById('address').value = ttSearchBox.getValue();
        })
    </script>
    
@endsection
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        @if (Auth::check()) 
            <meta name="user-id" content="{{ Auth::user()->id }}">
            <meta name="user-name" content="{{ Auth::user()->first_name }}">
            <meta name="user-email" content="{{ Auth::user()->email }}">
        @elseif (!Auth::check())
            <meta name="user-id" content="">
            <meta name="user-name" content="">
            <meta name="user-email" content="">
        @endif

        <title>BoolBnB</title>

        <!-- Fonts -->
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>
        <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css'/>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js"></script>
        <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.14.0/maps/maps.css'/>
    </head>
    <body>
        <div id="root"></div>
        
        {{-- JS --}}
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

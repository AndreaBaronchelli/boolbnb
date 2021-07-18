<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BoolBnB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        {{-- <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.14.0/maps/maps.css'/> --}}
        <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css'/>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js"></script>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>
    </head>
    <body>
        
        {{-- <header>
            <div class="logo">BoolBnB</div>
            <div id="header-right">
                <div id="searchbox"></div>
                <button id="search-button">Search</button>
            </div>
        </header> --}}
        <div id="root"></div>
        {{-- <div id='map' class='map'></div> --}}
        

        
        

        {{-- JS --}}
        {{-- <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.14.0/maps/maps-web.min.js'></script> --}}
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- <script src="{{ asset('js/map.js') }}"></script> --}}
        {{-- <script>
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
    
            document.getElementById('search-button').addEventListener('click', function(e) {
                axios.get(`http://127.0.0.1:8000/api/apartment/${ttSearchBox.getValue()}`)
                    .then(response => {
                        var responseapi = response.data;
                        console.log(responseapi);
                    })
                    .catch(err => {
                        console.log(err);
                    })
            })
        </script> --}}
        
    </body>
</html>

import axios from "axios";

var options = {
    searchOptions: {
        key: "HWJIfN6faq5SWzGHD4GKXdsexiZdkTDa",
        language: "en-GB",
        limit: 5
    },
    autocompleteOptions: {
        key: "HWJIfN6faq5SWzGHD4GKXdsexiZdkTDa",
        language: "en-GB"
    }
};

tt.setProductInfo("Boolbnb", "v-1");
tt.map({
    key: "HWJIfN6faq5SWzGHD4GKXdsexiZdkTDa",
    container: "map"
});

var map = tt.map({
    key: "HWJIfN6faq5SWzGHD4GKXdsexiZdkTDa",
    container: "map",
    center: [12.48, 41.90], //Roma
    zoom: 5
});

var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
var searchMarkersManager = new SearchMarkersManager(map);
ttSearchBox.on("tomtom.searchbox.resultsfound", handleResultsFound);
ttSearchBox.on("tomtom.searchbox.resultselected", handleResultSelection);
ttSearchBox.on("tomtom.searchbox.resultfocused", handleResultSelection);
ttSearchBox.on("tomtom.searchbox.resultscleared", handleResultClearing);
map.addControl(ttSearchBox, "top-left");

//search

function handleResultsFound(event) {
    var results = event.data.results.fuzzySearch.results;

    if (results.length === 0) {
        searchMarkersManager.clear();
    }
    searchMarkersManager.draw(results);
    fitToViewport(results);
}

function handleResultSelection(event) {
    var result = event.data.result;
    if (result.type === "category" || result.type === "brand") {
        return;
    }
    searchMarkersManager.draw([result]);
    fitToViewport(result);
}

function fitToViewport(markerData) {
    if (!markerData || (markerData instanceof Array && !markerData.length)) {
        return;
    }
    var bounds = new tt.LngLatBounds();
    if (markerData instanceof Array) {
        markerData.forEach(function(marker) {
            bounds.extend(getBounds(marker));
        });
    } else {
        bounds.extend(getBounds(markerData));
    }
    map.fitBounds(bounds, { padding: 100, linear: false, speed: 1.3 });
}

function getBounds(data) {
    var btmRight;
    var topLeft;
    if (data.viewport) {
        btmRight = [
            data.viewport.btmRightPoint.lng,
            data.viewport.btmRightPoint.lat
        ];
        topLeft = [
            data.viewport.topLeftPoint.lng,
            data.viewport.topLeftPoint.lat
        ];
    }
    return [topLeft, btmRight];
}

function handleResultClearing() {
    searchMarkersManager.clear();
}

//searcher marker manager

function SearchMarkersManager(map, options) {
    this.map = map;
    this._options = options || {};
    this._poiList = undefined;
    this.markers = {};
}

SearchMarkersManager.prototype.draw = function(poiList) {
    this._poiList = poiList;
    this.clear();
    this._poiList.forEach(function(poi) {
        var markerId = poi.id;
        var poiOpts = {
            name: poi.poi ? poi.poi.name : undefined,
            address: poi.address ? poi.address.freeformAddress : "",
            distance: poi.dist,
            classification: poi.poi
                ? poi.poi.classifications[0].code
                : undefined,
            position: poi.position,
            entryPoints: poi.entryPoints
        };
        var marker = new SearchMarker(poiOpts, this._options);
        marker.addTo(this.map);
        this.markers[markerId] = marker;
    }, this);
};

SearchMarkersManager.prototype.clear = function() {
    for (var markerId in this.markers) {
        var marker = this.markers[markerId];
        marker.remove();
    }
    this.markers = {};
    this._lastClickedMarker = null;
};

//add remove map
function SearchMarker(poiData, options) {
    this.poiData = poiData;
    this.options = options || {};
    this.marker = new tt.Marker({
        element: this.createMarker(),
        anchor: "bottom"
    });
    var lon = this.poiData.position.lng || this.poiData.position.lon;
    this.marker.setLngLat([lon, this.poiData.position.lat]);
}

SearchMarker.prototype.addTo = function(map) {
    this.marker.addTo(map);
    this._map = map;
    return this;
};

SearchMarker.prototype.createMarker = function() {
    var elem = document.createElement("div");
    elem.className = "tt-icon-marker-black tt-search-marker";
    if (this.options.markerClassName) {
        elem.className += " " + this.options.markerClassName;
    }
    var innerElem = document.createElement("div");
    innerElem.setAttribute(
        "style",
        "background: white; width: 10px; height: 10px; border-radius: 50%; border: 3px solid black;"
    );

    elem.appendChild(innerElem);
    return elem;
};

SearchMarker.prototype.remove = function() {
    this.marker.remove();
    this._map = null;
};

var apartmentsArray = [];

axios
    .get("http://127.0.0.1:8000/api/apartment")
    .then(response => {
        apartmentsArray = response.data.apartments;
        // console.log(apartmentsArray);

        // popup options
        var markerHeight = 50, markerRadius = 10, linearOffset = 25;
        var popupOffsets = {
        'top': [0, 0],
        'top-left': [0,0],
        'top-right': [0,0],
        'bottom': [0, -markerHeight],
        'bottom-left': [linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
        'bottom-right': [-linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
        'left': [markerRadius, (markerHeight - markerRadius) * -1],
        'right': [-markerRadius, (markerHeight - markerRadius) * -1]
        };

        apartmentsArray.forEach(apartment => {
            console.log(apartment);
            var marker = new tt.Marker()
                .setLngLat([apartment.longitude, apartment.latitude])
                .setPopup(new tt.Popup({offset: popupOffsets, className: 'myClass'})
                            .setLngLat([apartment.longitude, apartment.latitude])
                            .setHTML(`
                            <h2>${apartment.title}</h2>
                            <span>${apartment.address}</span><br>
                            <h4>Price: €${apartment.price}</h4>
                            <a href="#">View details</a>
                            `)
                )
                .addTo(map);
            // console.log(apartment)            
            // console.log(marker.getPopup());
        });
    })
    .catch(error => {
        console.log(error);
    });

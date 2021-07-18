<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApartmentController extends Controller
{
    //get apartment on frontend

    public function index(){

        // dd($address);
        $apartments = Apartment::all();

        return response()->json(compact('apartments'));

    }

    //get post detail by slug
    public function search($address){

        $response = Http::get("https://api.tomtom.com/search/2/search/${address}.json?radius=20000&key=4j77acI2RkgcxaYW2waGQ74SEPwpmFML");
        
        $posLat = $response->json()['results'][0]['position']['lat'];
        $posLon = $response->json()['results'][0]['position']['lon'];
        
        $minLat = $posLat - 0.2;
        $maxLat = $posLat + 0.2;
        $minLon = $posLon - 0.2;
        $maxLon = $posLon + 0.2;

        $apartments = Apartment::all()->whereBetween('latitude', [$minLat, $maxLat], 'longitude', [$minLon, $maxLon]);

        return response()->json($apartments);
    }

}


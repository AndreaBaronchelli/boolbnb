<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ApartmentController extends Controller
{
    //get apartment on frontend

    public function index(){

        // dd($address);
        $apartments = Apartment::all();

        return response()->json(compact('apartments'));

    }

    public function show($slug) {

        $apartment = Apartment::where('slug', $slug)->with('services')->first();

        return response()->json($apartment);
    }

    //get apartment detail by slug
    public function search($address){

        $response = Http::get("https://api.tomtom.com/search/2/search/${address}.json?radius=20000&key=4j77acI2RkgcxaYW2waGQ74SEPwpmFML");
        
        $posLat = $response->json()['results'][0]['position']['lat'];
        $posLon = $response->json()['results'][0]['position']['lon'];
        
        $minLat = $posLat - 0.2;
        $maxLat = $posLat + 0.2;
        $minLon = $posLon - 0.2;
        $maxLon = $posLon + 0.2;

        $apartments = Apartment::whereBetween('latitude', [$minLat, $maxLat])
            ->whereBetween('longitude', [$minLon, $maxLon]) 
            ->get();


        return response()->json($apartments);
    }

    public function advancedSearch($address, $radius, $rooms, $beds, $services) {
        //from services

        
        
        //coordiates from tomtom
        $response = Http::get("https://api.tomtom.com/search/2/search/${address}.json?radius=20000&key=4j77acI2RkgcxaYW2waGQ74SEPwpmFML");
    
        $posLat = $response->json()['results'][0]['position']['lat'];
        $posLon = $response->json()['results'][0]['position']['lon'];

        // filter by coordinates
        $base = 0.009009; //1km

        $minLat = $posLat - $base * $radius;
        $maxLat = $posLat + $base * $radius;
        $minLon = $posLon - $base * $radius;
        $maxLon = $posLon + $base * $radius;

        $apartments = Apartment::all()->whereBetween('latitude', [$minLat, $maxLat], 'longitude', [$minLon, $maxLon])->where('rooms', '>=', $rooms)->where('beds', '>=', $beds);

        // dd($apartments);

        $filteredApartments = [];

        foreach ($apartments as $apartment) {
            
            // ottieni id appartamento
            $id_apartment = $apartment->id;

            // ottieni tutti i servizi dell'appartamento
            $servizi_apartment = DB::table('apartment_service')->where([
                ['apartment_id', '=', $id_apartment]
            ])->get();

            // conteggio servizi trovati
            $founded = 0;

            
           

            // cerca servizi corrispodenti
            foreach ($servizi_apartment as $service) {
                if (in_array($service->service_id, $services)) {
                    $founded++;
                }
            }

            if( $founded == count($services) ){
                array_push($filteredApartments, $apartment);
            }
            


        }

        //dd($filteredApartments);
        //$services = Service::all();
        // $new_array= [];
        // $serviceArray = $services->toArray();
        // for ($i=0; $i<count($serviceArray); $i++) {
        //     foreach ($apartments->services as $apartment) {
        //         if ($apartment->id == $serviceArray[$i]) {
        //             array_push($new_array, $apartment);
        //         }
        //     }
        // }

        // $apartments->filter(function($))

        // dd($new_array);
        
        return response()->json($filteredApartments);
    }

}


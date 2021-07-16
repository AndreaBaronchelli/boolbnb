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
    public function show($address){
        // dump($address);

        $response = Http::get("https://api.tomtom.com/search/2/search/${address}.json?radius=20000&key=4j77acI2RkgcxaYW2waGQ74SEPwpmFML");
        
        $posLat = $response->json()['results'][0]['position']['lat'];
        $posLon = $response->json()['results'][0]['position']['lon'];
        

        $response = Http::get("https://api.tomtom.com/search/2/geometrySearch/${address}.json?geometryList=%7B%22type%22%3A%22CIRCLE%22%2C%20%22position%22%3A%22${posLat}%2C%20${posLon}%22%2C%20%22radius%22%3A20000%7D&key=4j77acI2RkgcxaYW2waGQ74SEPwpmFML");

        //TESTARE
        // $response = Http::get("https://api.tomtom.com/search/2/search/${address}.json?key=4j77acI2RkgcxaYW2waGQ74SEPwpmFML&lat=${posLat}&lon=${posLon}&radius=20000&idxSet=Str");
        
        dd($response->json());
        // $post = Post::where('slug', $slug)->with(['category','tags'])->first();
        // return response()->json($post); 
    }

}


<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    //get apartment on frontend

    public function index(){
        $apartments = Apartment::all();

        return response()->json(compact('apartments'));

    }

    //get post detail by slug
    public function show($address){
        dump($address);
        // $post = Post::where('slug', $slug)->with(['category','tags'])->first();
        // return response()->json($post); 
    }

}

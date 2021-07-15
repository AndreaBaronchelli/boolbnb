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
}

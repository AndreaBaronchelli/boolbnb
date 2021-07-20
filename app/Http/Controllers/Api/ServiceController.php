<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    //
    public function service() {
        $services = Service::all();

        return response()->json($services);
    }
}

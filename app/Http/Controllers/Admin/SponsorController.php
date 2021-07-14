<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\Sponsor;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SponsorController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all()->where('user_id', Auth::id());
        $sponsors = Sponsor::all();
        return view('admin.sponsors', compact('apartments', 'sponsors'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $apartment = Apartment::find($id);
        $sponsor = Sponsor::find($data['sponsors']);
        
        if (array_key_exists('sponsors', $data)) {
            $apartment->sponsors()->attach($data['sponsors'], ['start_time' => Carbon::now(), 'end_time' => Carbon::now()->addHours($sponsor['duration'])]);
        }

        return view('admin.home');
    }
}

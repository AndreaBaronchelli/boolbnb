<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Support\Facades\Auth;
use App\Sponsor;
use Braintree;
use Carbon\Carbon;

class SponsorhipController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $apartment = Apartment::with('sponsor')->find($id);
        // dd($apartment);
        $user_log = Auth::user();
        $sponsorships = Sponsor::all();

        $user_id = $user_log['id'];


        if ($apartment == null || count($apartment->sponsor) > 0) {
            return abort(403, 'Apartment does not exist or has already an active sponsorship.');
        } elseif ($apartment != null && $apartment['user_id'] == $user_id) {
            return view('admin.sponsorships.edit', compact('apartment', 'sponsor'));
        }

        abort(404);
    }
}

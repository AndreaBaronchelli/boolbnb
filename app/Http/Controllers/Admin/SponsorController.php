<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\Sponsor;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Http;
use Braintree\Gateway as Gateway;
use Braintree\Transaction as Transaction;

class SponsorController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all()->where('user_id', Auth::id());
        $sponsors = Sponsor::all();
        return view('admin.sponsors', compact('apartments', 'sponsors'));
    }
    
    public function braintree(Request $request, $id) 
    {
        $data = $request->all();

        $apartment = Apartment::find($id);
        $sponsor = Sponsor::find($data['sponsors']);
        

        return view('admin.payments.pay', compact('data', 'apartment', 'sponsor'));
    }

    public function store(Request $request, $id, $sponsor)
    {   
        $sponsor = Sponsor::find($sponsor);

        $apartment = Apartment::find($id);

        $payload = $request->input('payload', false);

        $status = Transaction::sale([
	        'amount' => $sponsor->price,
	        'paymentMethodNonce' => $payload['nonce'] ?? 'default value',
	        'options' => [
	        'submitForSettlement' => True
	        ]
        ]);
        if($status->success = false) {
            
        }

        $apartment->sponsors()->attach($sponsor->id, ['start_time' => Carbon::now(), 'end_time' => Carbon::now()->addHours($sponsor['duration'])]);

        return redirect()->route('admin.apartments.show', $apartment->id)->with('sponsored', $apartment->title);
    }
}

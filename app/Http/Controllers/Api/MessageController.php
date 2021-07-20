<?php

namespace App\Http\Controllers\Api;

use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    //
    public function send(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'num_guests' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'errors' => $validator->errors() ]);
        }

        $data = $request->all();

        // save
        $new_message = new Message();
        $new_message->fill($data);

        $new_message->save();
        
        return response()->json($data);
        // return response()->json($request->all());
    }
}

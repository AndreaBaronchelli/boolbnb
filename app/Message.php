<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'num_guests',
        'message'
    ];

    // Link to Apartments table
    public function apartments() {
        return $this->hasMany('App\Apartment');
    }
}

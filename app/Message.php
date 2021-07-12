<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Link to Apartments table
    public function apartments() {
        return $this->hasMany('App\Apartment');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Link to Apartments table
    public function apartments() {
        return $this->belongsToMany('App\Apartment');
    }
}

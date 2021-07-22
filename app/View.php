<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{

    protected $fillable = [
        'apartment_id',
        'IP_address',
        'country',
    ];

    // Link to Apartments table
    public function apartments() {
        return $this->hasMany('App\Apartment');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    // Link to Users table
    public function user() {
        return $this->belongsTo('App\User');
    }

    // Link to Messages table
    public function message() {
        return $this->belongsTo('App\Message');
    }

    // Link to Views table
    public function view() {
        return $this->belongsTo('App\View');
    }

    //Link to Services table
    public function services() {
        return $this->belongsToMany('App\Service');
    }

    // Link to Sponsors table
    public function sponsors() {
        return $this->belongsToMany('App\Sponsor');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugPharmacy extends Model
{
    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function drug(){
        return $this->belongsTo('App\Drug');
    }

    public function pharmacy(){
        return $this->belongsTo('App\Pharmacy');
    }
}

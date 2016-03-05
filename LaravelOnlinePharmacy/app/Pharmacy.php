<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{

    public function drugs(){
        return $this->belongsToMany('App\Drug', 'drug_pharmacies');
    }

//    public function users(){
//        return $this->belongsToMany('App\User');
//    }
}

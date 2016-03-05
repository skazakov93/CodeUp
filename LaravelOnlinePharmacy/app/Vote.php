<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'result',
        'voter_id',
        'delivery_id',
        'drug_pharmacy_id',
    ];

    public function voter(){
        return $this->belongsTo('App\User');
    }

    public function delivery(){
        return $this->belongsToMany('App\user');
    }

    public function drugPharuser(){
        return $this->belongsTo('App\DrugPharmacyUser');
    }


}

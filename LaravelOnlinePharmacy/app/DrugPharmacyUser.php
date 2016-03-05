<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugPharmacyUser extends Model
{
    protected $table = 'drug_pharmacy_user';

    public $timestamps = false;

    protected $fillable = [
        'delivery_price',
    ];

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function drugPharmacy(){
        return $this->belongsTo('App\DrugPharmacy');
    }

    public function drug(){
        return $this->belongsTo('App\Drug');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public $numOfLikes = 9;

    public $numOfDislikes = 3;
}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'adress',
        'email',
        'tel_number',
        'img_url',
    	'phar_id',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pharmacies(){
        return $this->belongsToMany('App\Pharmacy');
    }

    public function drugs(){
        return $this->belongsToMany('App\Drug');
    }

    public function selInto(){
        return $this->belongsToMany('App\DrugPharmacy');
    }

    public function sells(){
        return $this->belongsToMany('App\DrugPharmacyUser', 'drug_pharmacy_user');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
    public function daliveryFor(){
    	return $this->belongsTo('App\Pharmacy');
    }

    //ne ni treba
//    //A User can have many Articles!!!
//    public function buyers(){
//        return $this->hasMany('App\Buyer');
//    }
//
//    //A User can have many Articles!!!
//    public function distributors(){
//        return $this->hasMany('App\Distributor');
//    }
}

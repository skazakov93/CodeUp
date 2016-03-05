<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{

    protected $fillable = [
        'name',
        'desc',
        'img_url',
    ];

    public function setImgUrlAttribute($imgUrl){
    	if(strlen($imgUrl) > 10){
    		$this->attributes['img_url'] = $imgUrl;
    	}
    	else{
        	$this->attributes['img_url'] = "http://static4.i-apteka.pl/pol_pl_SUDAFED-60mg-x-12-tablelek-309_2.jpg";
    	}
    }

    //za da znaeme koj lek vo koja apteka mozeme da go najdeme
    public function pharmacies(){
        return $this->belongsToMany('App\Pharmacy');
    }

    public function drugPharmacy()
    {
        return $this->belongsTo('App\DrugPharmacy');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentDrug extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'drug_pharmacy_id',
        'comment_id',
    ];

    public function comment(){
        return $this->belongsTo('App\Comment');
    }

    public function drugPharmacyUser(){
        return $this->belongsTo('App\DrugPharmacyUser', 'drug_pharmacy_id');
    }
}

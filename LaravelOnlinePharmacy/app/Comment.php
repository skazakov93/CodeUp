<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $fillable = [
        'desc',
        'user_id',
    ];
    
    //protected $with = array('User');

    public function getCreatedAtAttribute($date){
        return Carbon::parse($date)->diffForHumans();
    }
    
    public function getDate(){
    	return $this->attributes['created_at'];
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function commentDrug(){
        return $this->belongsTo('App\CommentDrug');
    }
}

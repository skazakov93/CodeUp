<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NestedComment extends Model
{
    //
    protected $fillable=[
        'desc',
        'comment_id',
        'user_id',
    ];

    public function getCreatedAtAttribute($date){
        return Carbon::parse($date)->diffForHumans();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comment(){
        return $this->belongsTo('App\Comment');
    }
}

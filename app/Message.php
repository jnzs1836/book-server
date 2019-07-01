<?php

namespace App;

use Illuminate\Support\Facades\Validator;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Message extends Model{



    public $timestamps = true;


    public function sender(){
        return $this->belongsTo('App\User', 'sender_id');
    }
    public function receiver(){
        return $this->belongsTo('App\User', 'receiver_id');
    }

}
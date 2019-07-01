<?php

namespace App;

use Illuminate\Support\Facades\Validator;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model{
    public function issuer()
    {
        return $this->belongsTo('App\User', 'issuer_id');
    }

    public function applier()
    {
        return $this->belongsTo('App\User', 'applyer_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function book(){
        return $this->hasOne('App\Book', 'book_id');
    }

}
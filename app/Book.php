<?php

namespace App;

use Illuminate\Support\Facades\Validator;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Book extends Model{
    protected $fillable = ["id","origin_price","sell_price","author","category","introduction", "pic","ISBN","introduction"];

    public function findByChar($keywords){
        return ;
    }

    public function owner(){
        return $this->belongsTo('App\User', 'owner_id');
    }

}
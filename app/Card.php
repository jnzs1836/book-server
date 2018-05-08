<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model{
    protected $fillable = ["id","name","company","identity"];

    public function records(){
        return $this->hasMany('App\Record');
    }

    public function applications(){
        return $this->hasMany('App\Application');
    }


}
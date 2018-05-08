<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {
    protected $fillable = ["id","pwd","name","contact","salt"];

    public function records(){
        return $this->hasMany('App\Record','record_id');
    }
}
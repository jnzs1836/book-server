<?php

namespace App;

use Illuminate\Support\Facades\Validator;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Book extends Model{
    protected $fillable = ["id","category","name","author","year","price","stock","keep"];

    public function findByChar($keywords){
        return ;
    }
    public function records(){
        return $this->hasMany('App\Record','book_id');
    }

    public function applications(){
        return $this->hasMany('App\Application');
    }



//    public function requestBorrow($card, $admin){
//        $application = new Application;
//
//        $record = new Record;
//        $record->admin()->associate($admin);
//        $record->card()->associate($card);
//        $record->admin()->associate()
//        $this->records()->save($record);//wuguandeshidashabi
//    }
    
}
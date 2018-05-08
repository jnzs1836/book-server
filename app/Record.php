<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model {
    protected $fillable = ["borrowDate","dueDate"];

    public function card(){
        return $this->belongsTo('App\Card','card_id');
    }

    public function book(){
        return $this->belongsTo('App\Book','book_id');
    }

    public function admin(){
        return $this->belongsTo('App\Admin','admin_id');
    }

    public function fromApplication($application,$admin){
        $this->card()->associate($application->card()->first());
        $this->book()->associate($application->book()->first());
        $this->admin()->associate($admin);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: ktwzj
 * Date: 2018/5/4
 * Time: 16:22
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class Application extends Model
{
    public function card(){
        return $this->belongsTo('App\Card');
    }

    public function book(){
        return $this->belongsTo('App\Book');
    }
}
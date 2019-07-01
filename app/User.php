<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    // A user has multiple books
    public function books(){
        return $this->hasMany('App\Book','owner_id');
    }

    public function buyingOrders(){
        return $this->hasMany('App\Order','buyer_id');
    }

    public function sellingOrders(){
        return $this->hasMany('App\Order','seller_id');
    }
    
    public function issuedRewards(){
        return $this->hasMany('App\Reward','issuer_id');
    }

    public function appliedRewards(){
        return $this->hasMany('App\Reward','applier_id');
    }

    public function orders(){
        return $this->hasMany('App\Order','owner');
    }

    public function bidOrder(){
        return $this->morphOne('App\Order', 'orderable');
    }

    public function acceptOrder(){
        return $this->morphOne('App\Order', 'orderable');
    }

    public function sentMessages(){
        return $this->hasMany('App\Message', 'sender_id');
    }

    public function receivedMessages(){
        return $this->hasMany('App\Message', 'receiver_id');
    }

}

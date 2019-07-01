<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator;

use App\Reward;
use App\Book;
use App\Record;
use App\User;

class RewardController extends Controller{
    
    
    public function index(Request $request){
        $searchParam = $request->input('search_param');
        $searchParam =  "%". $searchParam. "%";
        $rewards = Reward::where('book_name', 'like', $searchParam)->orWhere('book_author', 'like', $searchParam)->orderby('book_name','decs')->get()->filter(function ($item) {
            return true;
        });
        $json = ['message'=>'求购列表','data'=>$rewards];
        return response()->json($json,200);
    }

    public function create(Request $request){
        $fillable = [
            'book_name', 'book_author', 'book_category', 'book_pic', 'book_press', "book_price",
            "description"
        ];
        $rules = ['book_name' => 'required', 'book_price' => 'required'];
        $this->validate($request,$rules);

        $user = $request->user();
        
        // Create a reward
        $reward = new Reward;
        $reward->issuer()->associate($user);
        foreach($fillable as $field){
            if($request->has($field)){
                $reward[$field] = $request->input($field);
            }
        }


        // Reponse
        $res = [];
        $code = 404;

        if($reward->save()){
            $res = ["created" => true, "reward_id"=> $reward->id];
            $code = 200;
        }else{
            $res = ["created" => false];
            $code = 500;
        }

        return response()->json($res,$code);
    }

    public function apply(Request $request){

    }

    public function confirm(Request $request){

    }
  
}

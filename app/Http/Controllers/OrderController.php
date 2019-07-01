<?php
/**
 * Created by PhpStorm.
 * User: ktwzj
 * Date: 2018/5/4
 * Time: 17:10
 */

namespace App\Http\Controllers;


use App\Admin;
use App\Application;
use App\User;
use App\Order;
use App\Book;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return $this->sendData("已返回所有记录",$orders);
    }

    public function available(){
        $orders = Order::all()->filter(function ($item){
            return $item->returned == False;
        });
        return $this->sendData('已返回所有记录',$orders);
    }

    

    
    public function create(Request $request){
        if ($request->has('api_token') && $request->has('book_id')) 
        {
            // $user = User:: where("name", "=", $request->input('name'))
            //     ->where("api-token", "=", $this->make($request->input('api-token')))
            //     ->first();
            $user = $request->user();
            $order = new Order;
            $book = Book::where( 'id', "=",$request->input('book_id'))->first();
            $order->buyer = $user;
            $order->seller = $user;
            $order->book = $book->id;
            $order->status = "created";
            // $order->address = $request->input('address');
            // $order->type = $request->input('type');
            $order->save();
            return response()->json(['message' => "创建成功"], 200);
        } else {
            return response()->json(['message' => "信息不完全"], 403);
        }
    }

    // Confirm an order for the buyer;
    public function confirm(Request $request){
        $rules = ['order_id' => 'required', 'accept' => 'required'];
        $this->validate($request,$rules);
        $order = Order::where('id', '=', $request->input('order_id'))->first();
        
        // res: responding info
        // status: respond status code
        $res = [];
        $statusCode = 404;
        
        // Check if the order is valid
        if($order->status != "created"){
            $res = ['message' => "Invalid or order already confirmed"];
            $statusCode = 403;
        }
        // Check order needs to be accepted or rejcted.
        else if(!$request->input('accept')){
            $order->status = "rejected";
            if($order->save()){
                $res = ['message' => "Order Rejected"];
                $statusCode = 200;
            }else{
                $res = ['message' => "Rejection Fails"];
                $statusCode = 500;
            }
        }
        // Order confirming
        else{
            $order->status = "confirmed";
            if($order->save()){
                $res = ['message' => "Order Confirmed"];
                $statusCode = 200;
            }else{
                $res = ['message' => "Creation Fails"];
                $statusCode = 500;
            }
        }
        return response()->json($res, $statusCode);
    }


    // When the user get the book, he needs to finish the order
    public function finish(Request $request){
        $rules = ['order_id' => 'required'];
        $this->validate($request,$rules);
        $order = Order::where('id', '=', $request->input('order_id'))->first();
        
        // res: responding info
        // status: respond status code
        $res = [];
        $statusCode = 404;
        
        if($order->status != "confirmed"){
            $res = ['message' => "Invalid or order already finished"];
            $statusCode = 403;
        }else{
            $order->status = "finished";
            if($order->save()){
                $res = ['message' => "Order Finished"];
                $statusCode = 200;
            }else{
                $res = ['message' => "Order Finished"];
                $statusCode = 500;
            }
        }

        return response()->json($res, $statusCode);
        
    }
}
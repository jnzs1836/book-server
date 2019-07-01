<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;
//  use App\Http\Controllers\Controller;

class UserController extends Controller
{

    private function make($value, array $options = array())
    {
        $value = env('SALT', '') . $value;
        return sha1($value);
    }

    public function login(Request $request)
    {

        if ($request->has('email') && $request->has('password')) {
            $user = User:: where("email", "=", $request->input('email'))
                ->where("password", "=", $this->make($request->input('password')))
                ->first();

            if ($user) {
                $token = str_random(60);
                $user->api_token = $token;
                $user->save();
                return response()->json(['message' => '登陆成功', 'api_token'=> $user->api_token, 'name' => $user->name]);
            } else {
                return response()->json(['message' => "账号或密码不正确，登录失败！"], 403);
            }
        } else {
            return response()->json(['message' => "登陆信息不完全"], 403);
        }
    }

    public function post(Request $request){
        $data = $request->all();
        $rules = ['name' => 'required|unique:admin|max:255', 'password' => 'required|confirmed|min:5', 'email' => 'required|email'];
        $messages = ['name.required' => '请填写用户名', 'email.unique' => '您的邮箱已被注册', 'password.required' => '请填写密码', 'password.confirmed' => '两次密码不匹配。'];
        $validator = Validator::make($data, $rules, $messages);
        if (false) {
            $user = new User;
            $user->name = $request->input('name');
            $json = [
                'message' => '信息不合法'
            ];
            $status = 403;
        } else {
            $checkUser = User::where("name", "=", $request->input('name'))->orwhere("email", "=", $request->input('email'))->first();
            if($checkUser){
                $json = [
                    'message' => "用户已存在！",
                    'created' => false,
                    ];
                $status = 403;
            }
            else{
                $user = User::create($data);
                $user->api_token = str_random(60);
                $user->password = $this->make($request->input('password'));
                $user->email = $request->input('email');
                if ($user->save()) {
                    $status = 200;
                    $json = [
                        'message' => "用户注册成功！",
                        'created' => true,
                        'api-token' => $user->api_token,
                        'user_id' => $user->id];
                } else {
                    $status = 500;
                    $json = [
                    'created' => false,
                    'message' => "用户注册失败！"
                ];
            }
            }
            

        }
        return response()->json($json, $status);
    }

    public function register(Request $request)
    {
        $data = Request::all();
        $rules = ['name' => 'required|unique:admin|max:255', 'password' => 'required|confirmed|min:5', 'email' => 'required|email'];
        $messages = ['name.required' => '请填写用户名', 'email.unique' => '您的邮箱已被注册', 'password.required' => '请填写密码', 'password.confirmed' => '两次密码不匹配。'];
        $validator = Validator::make($data, $rules, $messages);
        if (!$validator->passes()) {
            $user = new User;
            $user->name = $request->input('name');
            $json = [
                'message' => '信息不合法'
            ];
            $status = 403;
        } else {
            $user = User::create($data);
            $user->api_token = str_random(60);
            if ($user->save()) {
                $status = 200;
                $json = [
                    'user_id' => $user->id,
                    'message' => "用户注册成功！",
                    'api-token' => $user->api_token];
            } else {
                $status = 500;
                $json = [
                    'message' => "用户注册失败！"
                ];
            }

        }
        return response()->json($json, $status);
    }

    public function info(Request $request)
    {
        $user = $request->user();
        $data = [
            'bought' => sizeof($user->buyingOrders),
            'sold' => sizeof($user->sellingOrders),
            'books' => sizeof($user->books),
            'rewards' => sizeof($user->issuedRewards),
            'name' => $user->name,
            'email' => $user->email,
        ];
        
        return response()->json($data, 200);
    }

    public function get($id){
        $user = User::where('id',$id)->get();
        return $this->sendData('用户信息',$user);
    }

    public function index(){
        $users = User::orderby('name','decs')->get();
        return json_encode($users);
    }

    public function getBuyingOrders(Request $request){
        $user = $request->user();
        
        $orders = $user->buyingOrders;
        $returnedData = [];
        foreach($orders as $order){
            $order->book_name = $order->book->name;
            array_push($returnedData, $order);
        }
        return response()->json(['data' => $returnedData], 200);
        
    }

    public function getSellingOrders(Request $request){
        $user = $request->user();

        $orders = $user->sellingOrders;
        $returnedData = [];
        foreach($orders as $order){
            $order->book_name = $order->book->name;
            array_push($returnedData, $order);
        }
        return response()->json(['data' => $returnedData], 200);
    }

    public function books(Request $request){
        $user = $request->user();
        $books = $user->books;
        return response()->json(['data' => $books], 200);
    }

    public function rewards(Request $request){
        $user = $request->user();
        $rewards = $user->issuedRewards;
        return response()->json(['data' => $rewards], 200);
    }



}
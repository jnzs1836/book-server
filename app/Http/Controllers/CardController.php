<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Card;
use Auth;
use Illuminate\Support\Facades\Validator;
//  use App\Http\Controllers\Controller;

class CardController extends Controller
{

    private function make($value, array $options = array())
    {
        $value = env('SALT', '') . $value;
        return sha1($value);
    }

    public function login(Request $request)
    {

        if ($request->has('card_id') && $request->has('password')) {
            $card = Card:: where("id", "=", $request->input('card_id'))
                ->where("password", "=", $this->make($request->input('password')))
                ->first();

            if ($card) {
                $token = str_random(60);
                $card->api_token = $token;
                $card->save();
                return $card->api_token;
            } else {
                response()->json(['message' => "卡号或密码不正确，登录失败！"], 403);
            }
        } else {
            response()->json(['message' => "登陆信息不完全"], 403);
        }
    }

    public function post(Request $request){
        $data = Request::all();
        $rules = ['name' => 'required|unique:admin|max:255', 'password' => 'required|confirmed|min:5', 'email' => 'required|email'];
        $messages = ['name.required' => '请填写用户名', 'email.unique' => '您的邮箱已被注册', 'password.required' => '请填写密码', 'password.confirmed' => '两次密码不匹配。'];
        $validator = Validator::make($data, $rules, $messages);
        if (!$validator->passes()) {
            $card = new Card;
            $card->name = $request->input('name');
            $json = [
                'message' => '信息不合法'
            ];
            $status = 403;
        } else {
            $card = Card::create($data);
//    $card->name=$request->input('name');
//    $card->password=$this->make($request->input('password'));
//    $card->email=$request->input('email');
            $card->api_token = str_random(60);
            if ($card->save()) {
                $status = 200;
                $json = [
                    'message' => "用户注册成功！",
                    'api-token' => $card->api_token,
                    'card_id' => '123'];
            } else {
                $status = 500;
                $json = [
                    'message' => "用户注册失败！"
                ];
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
            $card = new Card;
            $card->name = $request->input('name');
            $json = [
                'message' => '信息不合法'
            ];
            $status = 403;
        } else {
            $card = Card::create($data);
//    $card->name=$request->input('name');
//    $card->password=$this->make($request->input('password'));
//    $card->email=$request->input('email');
            $card->api_token = str_random(60);
            if ($card->save()) {
                $status = 200;
                $json = [
                    'message' => "用户注册成功！",
                    'api-token' => $card->api_token];
            } else {
                $status = 500;
                $json = [
                    'message' => "用户注册失败！"
                ];
            }

        }
        return response()->json($json, $status);
    }

    public function info()
    {
        return Auth::card();
    }

    public function get($id){
        $card = Card::where('id',$id)->get();
        return $this->sendData('用户信息',$card);
    }

    public function index(){
        $cards = Card::orderby('name','decs')->get();
        return json_encode($cards);
    }


//    public function post(Request $request){
//        $card = new Card();
//        $card->name = $request->input('name');
//        $card->save();
//        return $this->sendData('创建用户',[]);
//    }
}
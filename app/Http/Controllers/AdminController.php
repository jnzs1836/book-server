<?php
/**
 * Created by PhpStorm.
 * User: ktwzj
 * Date: 2018/5/4
 * Time: 18:19
 */

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

use Illuminate\Contracts\Validation\Validator;

class AdminController extends Controller
{
    public function get($id){
        $admin = Admin::where('id',$id)->get();
        return $this->sendData('管理员信息',$admin);
    }

    public function index(){
        $admins = Admin::orderby('name','decs')->get();
        return json_encode($admins);
    }


    public function post(Request $request){
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->save();
        return $this->sendData('创建管理员',[]);
    }
}
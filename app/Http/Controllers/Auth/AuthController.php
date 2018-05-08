<?php

namespace App\Http\Controllers\newAuth;

use App\User;

use App\Http\Controllers\Controller;
use App\Status;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    private function make($value, array $options = array())
    {
        $value = env('SALT', '') . $value;
        return sha1($value);
    }

    private function check($value, $hashedValue, array $options = array())
    {
        return $this->make($value) === $hashedValue;
    }

    private function makeSession($admin)
    {
        session(['id' => $admin->id, 'username' => $admin->username, 'dep' => $admin->department, 'realname' => $admin->realname, 'privilege' => $admin->privilege]);
    }

    private function destroySession()
    {
        session(['id' => '', 'username' => '', 'dep' => '', 'realname' => '', 'privilege' => '']);
    }

    public function postLogin()
    {
        $admin = Request::all();

        $rules = ['username' => 'required|max:255', 'password' => 'required|min:5',];
        $messages = ['username.required' => '请填写用户名', 'password.required' => '请填写密码',];
        // 开始验证
        $validator = Validator::make($admin, $rules, $messages);

        if ($validator->passes()) {
            $username = $admin['username'];
            $password = $this->make($admin['password']);
            $admin = Admin::where('username', $username)->where('password', $password)->first();
            if (isset($admin['username'])) {
                $this->makeSession($admin);
                $admin->id_code = '';
                $admin->save();
                res = {'message':'登陆成功'};
            } else {
                res = {'message':'用户名或密码错误'};
            }
        } else {
            // 验证失败
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }


    public function postRegister()
    {
        $data = Request::all();

        $rules = ['username' => 'required|unique:admin|max:255', 'password' => 'required|confirmed|min:5', 'realname' => 'required', 'tel1' => 'required', 'email' => 'required|email', 'class' => 'required', 'qq' => 'required', 'birth' => 'required', 'dorm' => 'required', 'stuid' => 'required'];
        $messages = ['username.required' => '请填写用户名', 'username.unique' => '您的用户名已被注册', 'password.required' => '请填写密码', 'password.confirmed' => '两次密码不匹配。'];
        $validator = Validator::make($data, $rules, $messages);
        if (!$validator->passes()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if ($data['department'] == '-1' or $data['position'] == '-1') {
            return redirect()->back()->withInput()->withErrors("部门或身份未选择");
        }

        $privilegeMap[0] = "干事";
        $privilegeMap[1] = "副部长";
        $privilegeMap[2] = "总监";
        $privilegeMap[3] = "部长";
        $privilegeMap[4] = "副主席";
        $privilegeMap[5] = "主席";
        $privilegeMap[6] = "管理员";

        $data['password'] = $this->make($data['password']);
        $data['privilege'] = $data['position'];
        $data['position'] = $privilegeMap[$data['position']];
        $data['enabled'] = 0;
        $admin = Admin::create($data);
        $this->makeSession($admin);

        sendMail('emails.register', $data, $admin, "欢迎注册竺可桢学院学生会会网！");

        return redirect("/admin");
    }

    public function getLogout()
    {
        $this->destroySession();
        return redirect('login');
    }

    public function getFindPwd()
    {
        $username = Request::get('username');
        $admin = Admin::where("username", $username)->first();
        if ($username == '' or is_null($admin)) {
            return redirect()->back()->withErrors(['您的用户名输入有误']);
        }

        $id_code = rand(1000, 9999);
        sendMail('emails.find_pwd', ['id_code' => $id_code, 'realname' => $admin->realname], $admin, "竺可桢学院学生会会网密码找回");
        $admin->id_code = $id_code;
        $admin->save();

        return redirect('find_pwd_redirect/' . $username)->with('message', '邮件已经发送到' . $admin->email . ',请注意查收');
    }

    public function postFindPwd()
    {
        $data = Request::all();
        $rules = ['password' => 'required|confirmed|min:5', 'id_code' => 'required'];
        $messages = ['id_code.required' => '请填写验证码', 'password.required' => '请填写密码', 'password.confirmed' => '两次密码不匹配。'];

        $validator = Validator::make($data, $rules, $messages);
        $admin = Admin::where('username', $data['username'])->first();
        if (!$validator->passes() or $data['id_code'] != $admin->id_code) {
            return redirect()->back()->withInput()->withErrors($validator)->withErrors('验证码输入有误');
        }

        $admin->password = $this->make($data['password']);
        $admin->id_code = '';
        $admin->save();
        return redirect('login')->with('message', '修改密码成功');
    }

    public function redirectFindPwd($username)
    {
        return view("auth.find_pwd", ['username' => $username]);
    }

    public function getEditPwd()
    {
        return view("auth.edit_pwd");
    }

    public function postEditPwd()
    {
        $data = Request::all();
        $username = session('username');
        $rules = ['password' => 'required|confirmed|min:5'];
        $messages = ['password.required' => '请填写密码', 'password.confirmed' => '两次密码不匹配。'];

        $validator = Validator::make($data, $rules, $messages);
        if (!$validator->passes()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $admin = Admin::where('username', $username)->first();

        if (!$this->check($data['old_password'], $admin['password'])) return redirect()->back()->withInput()->withErrors('原密码错误!');

        $admin->password = $this->make($data['password']);
        $admin->save();

        return redirect('/admin');
    }
}

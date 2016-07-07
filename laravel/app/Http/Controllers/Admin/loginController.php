<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Session,DB,Hash,Validator;

class loginController extends Controller {

    public function index(Request $request) {
       $data = $request->old();
        return view("admin.login.index");
    }

    //  后台验证 登录验证
    public function logTodo(Request $request) {
//       echo"请过来验证";
        //接受数据 使用all接受赖在get传参过来的全部参数
        $data = $request->all();
//        if (session("code") != $data["code"]) {
//           $request->flash();
//           return back()->with(["info"=>"验证码错误"]);
//        }

//        有效性验证
    $this->validate($request,
    ["username"=>"required",
    "password"=>"required|between:6,15"],
    ["username.required"=>"账号未填写",
    "password.required"=>"密码不能为空",
    "password.between"=>"密码长度因为6-15位"
     ]);
//     
        //真实性验证
        $userRec = DB::table("user")->where("username", $data['username'])->first();
//    dd($userRec); 
        if (empty($userRec)) {
         $request->flash();
         return back()->with(["info"=>"账号不正确"]);
        } else if (!Hash::check($data['password'], $userRec->password)) {
         $request->flash();
         return back()->with(["info"=>"密码错误"]);
        } else {
            //将用户状态写入session 
//            session(['userData' => $userRec]);
//            return redirect("/Admin");
            Session::put("userData", $userRec);
                        Session::save();
			return redirect("/Admin");
        }
    }

    //生成验证码的方法
    public function captcha() {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 42, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('code', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    //退出登录
    public function logOut() {
        //销毁session
        Session::forget("userData");
        //跳转
        return redirect("/Admin");
    }

}
